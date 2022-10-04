<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Categories;
use App\Models\Sizes;
use App\Models\ItemsHasSizes;
use App\Models\AddOns;
use App\Models\ItemsHasAddOns;
use App\Models\Tables;
use App\Models\Orders;
use App\Models\OrderTypes;
use App\Models\PaymentTypes;
use App\Models\OrderItems;
use App\Models\Order_Items_has_Add_Ons;
use App\Models\Customers;
use App\Models\Drivers;
use App\Models\Orders_assigned_Drivers;
use App\Models\Customer_Settlements;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use illuminate\Support\Facades\Session;

use \PDF;

class CustomerOrderController extends Controller
{
    public function fetchCategories()
    {
        return Categories::where('active', 1)->where('deleted', 0)->get();
    }

    public function fetchAllItems()
    {
        return Items::where('active', 1)->where('deleted', 0)->get();
    }

    public function fetchTables()
    {
        return Tables::where('active', 1)->where('deleted', 0)->get();
    }

    public function fetchOrderId()
    {
        $order_id = Orders::select('id')->orderBy('id', 'desc')->first();

        if($order_id == null)
        {
            return 1;
        }
        else
        {
            return $order_id->id + 1;
        }
    }

    public function fetchCart()
    {
        return $cart = \Session::get('cart');
    }

    public function fetchCartTotal()
    {
        return $cart_total = \Session::get('total');
    }

    public function fetchAllItemsByCategory(Request $request)
    {

        $request->validate([
            'category_id' => 'required'
        ]);

        $category_id = $request->category_id;

        return Items::where('active', 1)->where('deleted', 0)->where('categories_id', $category_id)->get();
    }

    public function fetchAllSizesByItem(Request $request)
    {

        $request->validate([
            'item_id' => 'required'
        ]);

        $item_id = $request->item_id;

        $items_has_sizes = ItemsHasSizes::where('active', 1)->where('deleted', 0)->where('items_id', $item_id)->get();

        foreach($items_has_sizes as $items_has_size)
        {
            $sizes = Sizes::where('active', 1)->where('deleted', 0)->where('id', $items_has_size['sizes_id'])->first();
            $items_has_size['size_name'] = $sizes['name'];
            $items_has_size['size_adding_price'] = $sizes['adding_price'];
        }

        return $items_has_sizes;
    }

    public function fetchAllAddOnsByItem(Request $request)
    {

        $request->validate([
            'item_id' => 'required'
        ]);

        $item_id = $request->item_id;

        $items_has_add_ons = ItemsHasAddOns::where('active', 1)->where('deleted', 0)->where('items_id', $item_id)->get();

        foreach($items_has_add_ons as $items_has_add_on)
        {
            $add_ons = AddOns::where('active', 1)->where('deleted', 0)->where('id', $items_has_add_on['add_ons_id'])->first();
            $items_has_add_on['add_on_name'] = $add_ons['name'];
            $items_has_add_on['add_on_adding_price'] = $add_ons['adding_price'];
        }

        return $items_has_add_ons;
    }

    public function getSearchItems(Request $request)
    {
        $search_item = $request->search_item;
        $menu_stock_status = $request->menu_stock_status;

        if($menu_stock_status != null)
        {
            if($search_item != null)
            {
                return Items::where('name', 'like', $search_item . "%")->where('deleted', 0)->get();
            }
            else
            {
                return Items::where('deleted', 0)->get();
            }
        }
        else
        {
            if($search_item != null)
            {
                return Items::where('name', 'like', $search_item . "%")->where('active', 1)->where('deleted', 0)->get();
            }
            else
            {
                return Items::where('active', 1)->where('deleted', 0)->get();
            }
        }
    }

    public function getSelectedAddOns(Request $request)
    {
        $request->validate([
            'display_selected_add_ons' => 'required'
        ]);

        $display_selected_add_ons = $request->display_selected_add_ons;

        for($i=0; $i < count($display_selected_add_ons); $i++)
        {
            if($display_selected_add_ons[$i] != null)
            {
                $selected_add_ons[$i] = AddOns::where('id', $display_selected_add_ons[$i])->first();
            }
        }

        return $selected_add_ons;
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'item_id' => 'required',
            'item_price' => 'required',
            'quantity' => 'required',
        ]);

        // $cart = \Session::get('cart');
        // \Session::forget('cart', $cart);
        // $total_price = \Session::get('total');
        // \Session::forget('total', $total_price);
        // return 1;

        $item_id = $request->item_id;
        $item_price = $request->item_price;
        $quantity = $request->quantity;
        $size_id = $request->size_id;
        $selected_add_ons = $request->selected_add_ons;
        $add_ons_total_price = 0;

        $items = Items::where('id', $item_id)->get();

        $item_size_details = Sizes::where('id', $size_id)->first();
        $item_size = $item_size_details['name'];
        $item_size_price = $item_size_details['adding_price'];

        foreach($selected_add_ons as $selected_add_on)
        {
            $selected_add_on_price = AddOns::select('adding_price')->where('id', $selected_add_on)->first();
            $add_ons_total_price = $add_ons_total_price + $selected_add_on_price['adding_price'];
        }

        $item_sub_total = $quantity * $item_price + $item_size_price + $add_ons_total_price;

        $cart = \Session::get('cart');
        $total_price = \Session::get('total');

        if (!$cart) {
            $cart[$items[0]->id] = array(
                "item_id" => $items[0]->id,
                "item_image" => $items[0]->image,
                "item_name" => $items[0]->name,
                "item_price" => $items[0]->price,
                "item_sub_total" => $item_sub_total,
                "item_quantity" => $quantity,
                "item_size_id" => $size_id,
                "item_size_name" => $item_size,
                "item_add_ons" => $selected_add_ons,
            );

            \Session::put('cart', $cart);
            \Session::put('total', $item_sub_total);
            return $cart;
        }
        else
        {
            $cart[$items[0]->id] = array(
                "item_id" => $items[0]->id,
                "item_image" => $items[0]->image,
                "item_name" => $items[0]->name,
                "item_price" => $items[0]->price,
                "item_sub_total" => $item_sub_total,
                "item_quantity" => $quantity,
                "item_size_id" => $size_id,
                "item_size_name" => $item_size,
                "item_add_ons" => $selected_add_ons,
            );

            \Session::put('cart', $cart);
            $total_price = $total_price + $item_sub_total;
            \Session::put('total', $total_price);
            return $cart;
        }

        return 1;
    }

    public function update(Request $request)
    {
        $request->validate([
            'item_id' => 'required',
            'item_price' => 'required',
            'quantity' => 'required',
        ]);

        $item_id = $request->item_id;
        $item_price = $request->item_price;
        $quantity = $request->quantity;

        $items = Items::where('id', $item_id)->get();

        $item_sub_total = $quantity * $items[0]->price;

        $cart = \Session::get('cart');
        $total_price = \Session::get('total');

        if (isset($cart[$items[0]->id])) 
        {
            $cart[$items[0]->id]['item_quantity'] = $quantity;
            $previous_total = $cart[$items[0]->id]['item_sub_total'];
            $cart[$items[0]->id]['item_sub_total'] = $item_sub_total;

            \Session::put('cart', $cart);
            $total_price = $total_price - $previous_total + $item_sub_total;
            \Session::put('total', $total_price);
            return $total_price = \Session::get('total');
        }
    }

    public function destroy(Request $request)
    {
        $request->validate([
            'item_id' => 'required'
        ]);

        $item_id = $request->item_id;

        $cart = \Session::get('cart');
        $total_price = \Session::get('total');

        if(isset($cart[$item_id]))
        {
            $subtract_price = $cart[$item_id]['item_price'];
            $total_price = $total_price - $subtract_price;
            session()->put('total', $total_price);
            
            unset($cart[$item_id]);
            session()->put('cart', $cart);
        }

        return $cart;
    }

    public function submitOrder(Request $request)
    {
        $request->validate([
            'payment_method' => 'required'
        ]);

        $payment_method = $request->payment_method;
        $table_id = $request->table_id;
        $driver_id = $request->driver_id;
        $customer_id = $request->customer_id;
        $selected_order_type = $request->selected_order_type;

        $total_amount = \Session::get('total');
        $cart_items = \Session::get('cart');

        $order['subtotal'] = $total_amount;
        $order['tables_id'] = $table_id;
        $order['users_id'] = \Session::get('user_id');
        $order['customers_id'] = $customer_id;
        if($payment_method == "cash")
        {
            $order['payment_types_id'] = 1;
        }
        else if($payment_method == "card")
        {
            $order['payment_types_id'] = 2;
        }
        else if($payment_method == "credit")
        {
            $order['payment_types_id'] = 3;
        }
        if($selected_order_type == "dine_in")
        {
            $order['order_types_id'] = 1;
        }
        else if($selected_order_type == "take_away")
        {
            $order['order_types_id'] = 2;
        }
        if($selected_order_type == "delivery")
        {
            $order['order_types_id'] = 3;
        }

        $result = Orders::create($order);

        $orders_id = $result->id;

        foreach($cart_items as $cart_item)
        {
            $order_item_add['quantity'] = $cart_item['item_quantity'];
            $order_item_add['price'] = $cart_item['item_sub_total'];
            $order_item_add['items_id'] = $cart_item['item_id'];
            $order_item_add['sizes_id'] = $cart_item['item_size_id'];
            $order_item_add['orders_id'] = $orders_id;
            $order_item_add['users_id'] = \Session::get('user_id');

            $result2 = OrderItems::create($order_item_add);
            $order_item_id = $result2->id;

            if($cart_item['item_add_ons'] != null)
            {
                $cart_item_add_ons = $cart_item['item_add_ons'];

                foreach($cart_item_add_ons as $key => $value)
                {
                    $order_item_has_add_on['order_items_id'] = $order_item_id;
                    $order_item_has_add_on['add_ons_id'] = $value;

                    $result3 = Order_Items_has_Add_Ons::create($order_item_has_add_on);
                }
            }
        }

        if($selected_order_type == "delivery")
        {
            $delivery_order['orders_id'] = $orders_id;
            $delivery_order['drivers_id'] = $driver_id;

            $result4 = Orders_assigned_Drivers::create($delivery_order);
        }

        if($payment_method == "credit")
        {
            if($customer_id != null)
            {
                $last_settlement = Customer_Settlements::where('customers_id', $customer_id)->orderBy('date', 'DESC')->first();

                if($last_settlement != null)
                {
                    $balance_amount = $last_settlement['balance_amount'] + $total_amount;
                }
                else
                {
                    $balance_amount = $total_amount;
                }
            }
            else
            {
                $balance_amount = null;
            }

            $customer_settlement['customers_id'] = $customer_id;
            $customer_settlement['orders_id'] = $orders_id;
            $customer_settlement['credit_amount'] = $total_amount;
            $customer_settlement['balance_amount'] = $balance_amount;
            $customer_settlement['date'] = date("Y-m-d");

            $result5 = Customer_Settlements::create($customer_settlement);
        }

        if($result && $result2 || $result3 || $result4 || $result5)
        {
            $cart = \Session::get('cart');
            \Session::forget('cart', $cart);
            $total_price = \Session::get('total');
            \Session::forget('total', $total_price);

            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function fetchDataToBill(Request $request)
    {
        $order_details = Orders::orderBy('created_at', 'DESC')->limit(1)->get();

        foreach($order_details as $order_detail)
        {
            $order_type_details = OrderTypes::where('id', $order_detail['order_types_id'])->first();
            $order_detail['order_type'] = $order_type_details['name'];

            $payment_type_details = PaymentTypes::where('id', $order_detail['payment_types_id'])->first();
            $order_detail['payment_type'] = $payment_type_details['name'];

            $customer_details = Customers::where('id', $order_detail['customers_id'])->first();
            $order_detail['customer_name'] = $customer_details['name'];
            $order_detail['customer_telephone'] = $customer_details['telephone'];
            if($customer_details['room_number'] != null)
            {
                $order_detail['customer_address'] = $customer_details['building_name']. ", " .$customer_details['area'];
            }
            else
            {
                $order_detail['customer_address'] = $customer_details['area'];
            }
            $order_detail['customer_room_number'] = $customer_details['room_number'];

            $order_item_details = OrderItems::where('orders_id', $order_detail['id'])->get();

            foreach($order_item_details as $order_item_detail)
            {
                $item_details = Items::where('id', $order_item_detail['items_id'])->first();
                $order_item_detail['item_name'] = $item_details['name'];
                $order_item_detail['item_quantity'] = $item_details['quantity'];
                $order_item_detail['item_price'] = $order_item_detail['price'];

                $size_details = Sizes::where('id', $order_item_detail['sizes_id'])->first();
                $order_item_detail['item_size'] = $size_details['name'];
            }

            $order_detail['items'] = $order_item_details;
            
        }

        $mpdf = new \Mpdf\Mpdf();
        // PORTRAIT BY DEFAULT, WE CAN ALSO SET LANDSCAPE
        // $mpdf = new \Mpdf\Mpdf(["orientation" => "L"]);
        
        // (B) OPTIONAL META DATA + PASSWORD PROTECTION
        $mpdf->SetTitle("Document Title");
        $mpdf->SetAuthor("Jon Doe");
        $mpdf->SetCreator("Code Boxx");
        $mpdf->SetSubject("Demo");
        $mpdf->SetKeywords("Demo", "Testing");
        // $mpdf->SetProtection([], "user", "password");
        
        // (C) THE HTML
        $html = "<html>
        <head>
            <div>

                <div>
                    <div>
                        <h4>HADDIYA COFFE HOUSE & RESTAURANT</h4>
                        <h5>TAX INVOICE</h5>
                        <h5>BEHIND DNATA, NERA CLOCK TOWER </h5>
                        <h5>DEIRA, DUBAI, U.A.E </h5>
                        <h5>PH:04 239 4455, 052 579 2173</h5>
                        <h5>TRN: 100255517300003 </h5>
                    </div>
                </div>

                <div>
                    <div><span >Order #:</span><span>
                            40</span></div>
                    <div><span>Date: </span><span>
                            05/08/2022</span></div>
                </div>

                <div>
                    <div><span>Order Type: </span><span>
                            Delivery</span></div>
                    <div><span>Payment Type: </span><span>
                            Credit</span></div>
                    <div><span>Address: </span><span>
                            Negombo</span></div>
                    <div><span>Customer:</span><span>
                            Rusiru Dananga</span></div>
                    <div><span>Phone:</span><span>
                            0762330036</span></div>
                    <div><span>Room No:</span><span>
                            101</span></div>

                </div>
            
                <div>

                    <table>
                        <thead>
                            <tr>
                                <th>
                                    <h5>Item</h5>
                                </th>
                                <th>
                                    <h5>Size</h5>
                                </th>
                                <th>
                                    <h5>Qty</h5>
                                </th>
                                <th>
                                    <h5>Total(AED)</h5>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Item 1</td>
                                <td>Size 1</td>
                                <td>Quantity 1</td>
                                <td>Total 1</td>
                            </tr>
                            <tr>
                                <td>
                                    <h4>Grand Total</h4>
                                </td>
                                <td></td>
                                <td></td>
                                <td>1000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div>
                    <div>
                        <h6>Thank you | visit again</h6>
                    </div>
                </div>
                
            </div>

        </html>";
        // OR WE CAN JUST READ FROM A FILE
        // $html = file_get_contents("PAGE.HTML");
        
        // (D) WRITE HTML TO PDF
        $mpdf->WriteHTML($html);
        
        // (E) OUTPUT
        // (E1) DIRECTLY SHOW IN BROWSER
        // $mpdf->Output();

        // (E2) FORCE DOWNLOAD
        $mpdf->Output("D:/Movies/demo.pdf");

        // (E3) SAVE TO FILE ON SERVER
        // $mpdf->Output("demo.pdf");

        return $order_details;
    }

    public function searchCustomers(Request $request)
    {

        $search_customer = $request->search_customer;

        if($search_customer == null)
        {
            return Customers::where('deleted', 0)->get();
        }
        else
        {
            return Customers::where('name', 'like', '%'.$search_customer.'%')->orWhere('telephone', 'like', '%'.$search_customer.'%')->where('deleted', 0)->get();
        }

    }

    public function searchDrivers(Request $request)
    {

        $search_driver = $request->search_driver;

        if($search_driver == null)
        {
            return Drivers::where('deleted', 0)->get();
        }
        else
        {
            return Drivers::where('name', 'like', '%'.$search_driver.'%')->orWhere('telephone', 'like', '%'.$search_driver.'%')->where('deleted', 0)->get();
        }

    }
}