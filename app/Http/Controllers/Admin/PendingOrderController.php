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
use App\Models\Customers;
use App\Models\Drivers;
use App\Models\PaymentTypes;
use App\Models\OrderTypes;
use App\Models\Orders_assigned_Drivers;
use App\Models\Order_Items_has_Add_Ons;
use App\Models\Customer_Settlements;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PendingOrderController extends Controller
{
    public function index()
    {
        $all_orders = Orders::orderBy('created_at', 'DESC')->get();

        foreach($all_orders as $all_order)
        {
            if($all_order['customers_id'] != null)
            {
                $customer_details = Customers::where('id', $all_order['customers_id'])->first();
                $all_order['customer_name'] = $customer_details['name'];
                $all_order['customer_building_name'] = $customer_details['building_name'];
                $all_order['customer_room_no'] = $customer_details['room_number'];
                $all_order['customer_area'] = $customer_details['area'];
                $all_order['customer_telephone'] = $customer_details['telephone'];
            }
            else
            {
                $all_order['customer_name'] = "Not Assigned";
                $all_order['customer_building_name'] = "Not Assigned";
                $all_order['customer_room_no'] = "Not Assigned";
                $all_order['customer_area'] = "Not Assigned";
                $all_order['customer_telephone'] = "Not Assigned";
            }

            $driver_order = Orders_assigned_Drivers::where('orders_id', $all_order['id'])->first();

            if($driver_order != null)
            {
                $driver_details = Drivers::where('id', $driver_order['drivers_id'])->first();
                $all_order['driver_name'] = $driver_details['name'];
            }
            else
            {
                $all_order['driver_name'] = "Not Assigned";
            }

            $order_type_details = OrderTypes::where('id', $all_order['order_types_id'])->first();
            $all_order['order_type'] = $order_type_details['name'];

            $payment_type_details = OrderTypes::where('id', $all_order['payment_types_id'])->first();
            $all_order['pyament_method'] = $payment_type_details['name'];
        }

        return $all_orders;
    }

    public function fetchOrderItems(Request $request)
    {
        $request->validate([
            'order_id' => 'required'
        ]);

        $order_id = $request->order_id;

        $order_items = OrderItems::where('orders_id', $order_id)->get();

        foreach($order_items as $order_item)
        {
            $item_details = Items::where('id', $order_item['items_id'])->first();
            $order_item['item_name'] = $item_details['name'];

            $size_details = Sizes::where('id', $order_item['sizes_id'])->first();
            $order_item['size_name'] = $size_details['name'];
        }

        return $order_items;
    }

    public function setCustomer(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'order_id' => 'required'
        ]);

        $customer_id = $request->customer_id;
        $order_id = $request->order_id;

        $order_update = Orders::where('id', $order_id)
                                ->update([
                                    'customers_id' => $customer_id,
                                    'updated_at' => date("Y-m-d H:i:s")
                                    ]);

        if($customer_id != null)
        {
            $last_settlement = Customer_Settlements::whereNotNull('balance_amount')->where('customers_id', $customer_id)->orderBy('date', 'DESC')->first();
            $order_details = Orders::where('id', $order_id)->first();

            if($last_settlement != null)
            {
                $balance_amount = $last_settlement['balance_amount'] + $order_details['subtotal'];
            }
            else
            {
                $balance_amount = $order_details['subtotal'];
            }
        }

        $customer_settlement_update = Customer_Settlements::where('orders_id', $order_id)
                                ->update([
                                    'customers_id' => $customer_id,
                                    'balance_amount' => $balance_amount,
                                    'updated_at' => date("Y-m-d H:i:s")
                                    ]);

        if($order_update){
            return 1;
        }else{
            return 0;
        }
    }

    public function setDriver(Request $request)
    {
        $request->validate([
            'driver_id' => 'required',
            'order_id' => 'required'
        ]);

        $driver_id = $request->driver_id;
        $order_id = $request->order_id;

        $order_update = Orders_assigned_Drivers::where('orders_id', $order_id)
                                ->update([
                                    'drivers_id' => $driver_id,
                                    'updated_at' => date("Y-m-d H:i:s")
                                    ]);

        if($order_update){
            return 1;
        }else{
            return 0;
        }
    }

}