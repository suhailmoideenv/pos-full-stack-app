<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Categories;
use App\Models\Orders;
use App\Models\Tables;
use App\Models\OrderItems;
use App\Models\Sizes;
use App\Models\AddOns;
use App\Models\Order_Items_has_Add_Ons;
use App\Models\OrderTypes;
use App\Models\PaymentTypes;
use App\Models\Customers;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class KitchenOrderController extends Controller
{
    public function fetchPendingOrders()
    {
        $orders = Orders::where('status', 0)->orderBy('id', 'desc')->get();

        foreach($orders as $order)
        {
            $table_details = Tables::where('id', $order['tables_id'])->first();
            $order['table_name'] = $table_details['name'];

            $order_items = OrderItems::where('orders_id', $order['id'])->get();
            $order['order_item_details'] = $order_items;
            $order['orders_items_count'] = count($order_items);

            $order_types = OrderTypes::where('id', $order['order_types_id'])->first();
            $order['order_type'] = $order_types['name'];

            $customer = Customers::where('id', $order['customers_id'])->first();
            $order['customer_name'] = $customer['name'];

            $order['order_completed_count'] = count(OrderItems::where('completed', 1)->where('orders_id', $order['id'])->get());

            foreach($order_items as $order_item)
            {
                $item_details = Items::where('id', $order_item['items_id'])->first();
                $order_item['item_image'] = $item_details['image'];
                $order_item['item_name'] = $item_details['name'];

                $item_sizes = Sizes::where('id', $order_item['sizes_id'])->first();
                $order_item['size_name'] = $item_sizes['name'];

                $item_has_add_ons = Order_Items_has_Add_Ons::where('order_items_id', $order_item['id'])->get();
                $order_item['item_has_add_on_details'] = $item_has_add_ons;

                foreach($item_has_add_ons as $item_has_add_on)
                {
                    $add_ons_details = AddOns::where('id', $item_has_add_on['add_ons_id'])->first();
                    $item_has_add_on['add_on_name'] = $add_ons_details['name'];
                }
            }
        }

        return $orders;
    }

    public function fetchPendingOrderDetails(Request $request)
    {
        $order_id = $request->order_id;
        $pending_order_status = $request->pending_order_status;

        if($pending_order_status != null)
        {
            $orders = Orders::where('id', $order_id)->orderBy('id', 'desc')->get();

            foreach($orders as $order)
            {
                $table_details = Tables::where('id', $order['tables_id'])->first();
                $order['table_name'] = $table_details['name'];

                $order_items = OrderItems::where('orders_id', $order['id'])->get();
                $order['order_item_details'] = $order_items;
                $order['orders_items_count'] = count($order_items);

                $order_types = OrderTypes::where('id', $order['order_types_id'])->first();
                $order['order_type'] = $order_types['name'];

                $customer = Customers::where('id', $order['customers_id'])->first();
                $order['customer_name'] = $customer['name'];

                $order['order_completed_count'] = count(OrderItems::where('completed', 1)->where('orders_id', $order['id'])->get());

                foreach($order_items as $order_item)
                {
                    $item_details = Items::where('id', $order_item['items_id'])->first();
                    $order_item['item_image'] = $item_details['image'];
                    $order_item['item_name'] = $item_details['name'];

                    $item_sizes = Sizes::where('id', $order_item['sizes_id'])->first();
                    $order_item['size_name'] = $item_sizes['name'];

                    $item_has_add_ons = Order_Items_has_Add_Ons::where('order_items_id', $order_item['id'])->get();
                    $order_item['item_has_add_on_details'] = $item_has_add_ons;

                    foreach($item_has_add_ons as $item_has_add_on)
                    {
                        $add_ons_details = AddOns::where('id', $item_has_add_on['add_ons_id'])->first();
                        $item_has_add_on['add_on_name'] = $add_ons_details['name'];
                    }
                }
            }
        }
        else
        {
            $orders = Orders::where('id', $order_id)->where('status', 0)->orderBy('id', 'desc')->get();

            foreach($orders as $order)
            {
                $table_details = Tables::where('id', $order['tables_id'])->first();
                $order['table_name'] = $table_details['name'];

                $order_items = OrderItems::where('orders_id', $order['id'])->get();
                $order['order_item_details'] = $order_items;
                $order['orders_items_count'] = count($order_items);

                $order_types = OrderTypes::where('id', $order['order_types_id'])->first();
                $order['order_type'] = $order_types['name'];

                $customer = Customers::where('id', $order['customers_id'])->first();
                $order['customer_name'] = $customer['name'];

                $order['order_completed_count'] = count(OrderItems::where('completed', 1)->where('orders_id', $order['id'])->get());

                foreach($order_items as $order_item)
                {
                    $item_details = Items::where('id', $order_item['items_id'])->first();
                    $order_item['item_image'] = $item_details['image'];
                    $order_item['item_name'] = $item_details['name'];

                    $item_sizes = Sizes::where('id', $order_item['sizes_id'])->first();
                    $order_item['size_name'] = $item_sizes['name'];

                    $item_has_add_ons = Order_Items_has_Add_Ons::where('order_items_id', $order_item['id'])->get();
                    $order_item['item_has_add_on_details'] = $item_has_add_ons;

                    foreach($item_has_add_ons as $item_has_add_on)
                    {
                        $add_ons_details = AddOns::where('id', $item_has_add_on['add_ons_id'])->first();
                        $item_has_add_on['add_on_name'] = $add_ons_details['name'];
                    }
                }
            }
        }

        return $orders;
    }

    public function fetchCompletedOrders()
    {
        $orders = Orders::where('status', 1)->orderBy('id', 'desc')->get();

        foreach($orders as $order)
        {
            $table_details = Tables::where('id', $order['tables_id'])->first();
            $order['table_name'] = $table_details['name'];

            $order_items = OrderItems::where('orders_id', $order['id'])->get();
            $order['order_item_details'] = $order_items;
            $order['orders_items_count'] = count($order_items);

            $order_types = OrderTypes::where('id', $order['order_types_id'])->first();
            $order['order_type'] = $order_types['name'];

            $customer = Customers::where('id', $order['customers_id'])->first();
            $order['customer_name'] = $customer['name'];

            $order['order_completed_count'] = count(OrderItems::where('completed', 1)->where('orders_id', $order['id'])->get());

            foreach($order_items as $order_item)
            {
                $item_details = Items::where('id', $order_item['items_id'])->first();
                $order_item['item_image'] = $item_details['image'];
                $order_item['item_name'] = $item_details['name'];

                $item_sizes = Sizes::where('id', $order_item['sizes_id'])->first();
                $order_item['size_name'] = $item_sizes['name'];

                $item_has_add_ons = Order_Items_has_Add_Ons::where('order_items_id', $order_item['id'])->get();
                $order_item['item_has_add_on_details'] = $item_has_add_ons;

                foreach($item_has_add_ons as $item_has_add_on)
                {
                    $add_ons_details = AddOns::where('id', $item_has_add_on['add_ons_id'])->first();
                    $item_has_add_on['add_on_name'] = $add_ons_details['name'];
                }
            }
        }

        return $orders;
    }

    public function fetchCompletedOrderDetails(Request $request)
    {
        $order_id = $request->order_id;

        $orders = Orders::where('id', $order_id)->where('status', 1)->orderBy('id', 'desc')->get();

        foreach($orders as $order)
        {
            $table_details = Tables::where('id', $order['tables_id'])->first();
            $order['table_name'] = $table_details['name'];

            $order_items = OrderItems::where('orders_id', $order['id'])->get();
            $order['order_item_details'] = $order_items;
            $order['orders_items_count'] = count($order_items);

            $order_types = OrderTypes::where('id', $order['order_types_id'])->first();
            $order['order_type'] = $order_types['name'];

            $customer = Customers::where('id', $order['customers_id'])->first();
            $order['customer_name'] = $customer['name'];

            $order['order_completed_count'] = count(OrderItems::where('completed', 1)->where('orders_id', $order['id'])->get());

            foreach($order_items as $order_item)
            {
                $item_details = Items::where('id', $order_item['items_id'])->first();
                $order_item['item_image'] = $item_details['image'];
                $order_item['item_name'] = $item_details['name'];

                $item_sizes = Sizes::where('id', $order_item['sizes_id'])->first();
                $order_item['size_name'] = $item_sizes['name'];

                $item_has_add_ons = Order_Items_has_Add_Ons::where('order_items_id', $order_item['id'])->get();
                $order_item['item_has_add_on_details'] = $item_has_add_ons;

                foreach($item_has_add_ons as $item_has_add_on)
                {
                    $add_ons_details = AddOns::where('id', $item_has_add_on['add_ons_id'])->first();
                    $item_has_add_on['add_on_name'] = $add_ons_details['name'];
                }
            }
        }

        return $orders;
    }

    public function fetchCanceledOrders()
    {
        $orders = Orders::where('status', 2)->orderBy('id', 'desc')->get();

        foreach($orders as $order)
        {
            $table_details = Tables::where('id', $order['tables_id'])->first();
            $order['table_name'] = $table_details['name'];

            $order_items = OrderItems::where('orders_id', $order['id'])->get();
            $order['order_item_details'] = $order_items;
            $order['orders_items_count'] = count($order_items);

            $order_types = OrderTypes::where('id', $order['order_types_id'])->first();
            $order['order_type'] = $order_types['name'];

            $customer = Customers::where('id', $order['customers_id'])->first();
            $order['customer_name'] = $customer['name'];

            $order['order_completed_count'] = count(OrderItems::where('completed', 1)->where('orders_id', $order['id'])->get());

            foreach($order_items as $order_item)
            {
                $item_details = Items::where('id', $order_item['items_id'])->first();
                $order_item['item_image'] = $item_details['image'];
                $order_item['item_name'] = $item_details['name'];

                $item_sizes = Sizes::where('id', $order_item['sizes_id'])->first();
                $order_item['size_name'] = $item_sizes['name'];

                $item_has_add_ons = Order_Items_has_Add_Ons::where('order_items_id', $order_item['id'])->get();
                $order_item['item_has_add_on_details'] = $item_has_add_ons;

                foreach($item_has_add_ons as $item_has_add_on)
                {
                    $add_ons_details = AddOns::where('id', $item_has_add_on['add_ons_id'])->first();
                    $item_has_add_on['add_on_name'] = $add_ons_details['name'];
                }
            }
        }

        return $orders;
    }

    public function fetchCanceledOrderDetails(Request $request)
    {
        $order_id = $request->order_id;

        $orders = Orders::where('id', $order_id)->where('status', 2)->orderBy('id', 'desc')->get();

        foreach($orders as $order)
        {
            $table_details = Tables::where('id', $order['tables_id'])->first();
            $order['table_name'] = $table_details['name'];

            $order_items = OrderItems::where('orders_id', $order['id'])->get();
            $order['order_item_details'] = $order_items;
            $order['orders_items_count'] = count($order_items);

            $order_types = OrderTypes::where('id', $order['order_types_id'])->first();
            $order['order_type'] = $order_types['name'];

            $customer = Customers::where('id', $order['customers_id'])->first();
            $order['customer_name'] = $customer['name'];

            $order['order_completed_count'] = count(OrderItems::where('completed', 1)->where('orders_id', $order['id'])->get());

            foreach($order_items as $order_item)
            {
                $item_details = Items::where('id', $order_item['items_id'])->first();
                $order_item['item_image'] = $item_details['image'];
                $order_item['item_name'] = $item_details['name'];

                $item_sizes = Sizes::where('id', $order_item['sizes_id'])->first();
                $order_item['size_name'] = $item_sizes['name'];

                $item_has_add_ons = Order_Items_has_Add_Ons::where('order_items_id', $order_item['id'])->get();
                $order_item['item_has_add_on_details'] = $item_has_add_ons;

                foreach($item_has_add_ons as $item_has_add_on)
                {
                    $add_ons_details = AddOns::where('id', $item_has_add_on['add_ons_id'])->first();
                    $item_has_add_on['add_on_name'] = $add_ons_details['name'];
                }
            }
        }

        return $orders;
    }

    public function completeOrderItem(Request $request)
    {
        $request->validate([
            'order_item_id' => 'required',
            'order_id' => 'required'
        ]);

        $order_item_id = $request->order_item_id;
        $order_id = $request->order_id;

        $order_item_update = OrderItems::where('id', $order_item_id)
                                ->update([
                                    'completed' => 1,
                                    'canceled' => 0,
                                    ]);

        $all_order_items = OrderItems::where('orders_id', $order_id)->get()->count();
        $completed_order_items = OrderItems::where('orders_id', $order_id)->where('completed', 1)->get()->count();

        if($all_order_items == $completed_order_items)
        {
            $order_update = Orders::where('id', $order_id)
                                ->update([
                                    'status' => 1
                                    ]);
        }

        if($order_item_update){
            return 1;
        }else{
            return 0;
        }
    }

    public function cancelOrderItem(Request $request)
    {
        $request->validate([
            'order_item_id' => 'required',
            'order_id' => 'required'
        ]);

        $order_item_id = $request->order_item_id;
        $order_id = $request->order_id;

        $order_item_update = OrderItems::where('id', $order_item_id)
                                ->update([
                                    'completed' => 0,
                                    'canceled' => 1
                                    ]);

        $all_order_items = OrderItems::where('orders_id', $order_id)->get()->count();
        $canceled_order_items = OrderItems::where('orders_id', $order_id)->where('canceled', 1)->get()->count();

        if($all_order_items == $canceled_order_items)
        {
            $order_update = Orders::where('id', $order_id)
                                ->update([
                                    'status' => 2
                                    ]);
        }

        if($order_item_update){
            return 1;
        }else{
            return 0;
        }
    }

    public function deliverOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required'
        ]);

        $order_id = $request->order_id;

        $order_update = Orders::where('id', $order_id)
                                ->update([
                                    'status' => 1
                                    ]);

        if($order_update){
            return 1;
        }else{
            return 0;
        }
    }

    public function cancelOrder(Request $request)
    {
        $request->validate([
            'order_id' => 'required'
        ]);

        $order_id = $request->order_id;

        $order_update = Orders::where('id', $order_id)
                                ->update([
                                    'status' => 2
                                    ]);

        $order_details = Orders::where('id', $order_id)->get();

        foreach($order_details as $order_detail)
        {
            $order_update = OrderItems::where('orders_id', $order_id)
                                ->update([
                                    'completed' => 0,
                                    'canceled' => 1,
                                    ]);
        }

        if($order_update){
            return 1;
        }else{
            return 0;
        }
    }

    public function fetchDataToBillKitchen(Request $request)
    {
        $order_id = $request->order_id;

        $order_details = Orders::where('id', $order_id)->get();

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

        return $order_details;
    }


}