<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Orders;
use App\Models\Customers;
use App\Models\Customer_Settlements;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AdminPendingOrderController extends Controller
{
    public function index()
    {
        $orders = Orders::where('payment_types_id', null)->orderBy('created_at', 'DESC')->get();

        foreach($orders as $order)
        {
            $customer = Customers::where('id', $order['customers_id'])->first();
            $order['customer_name'] = $customer['name'];
        }

        return $orders;
    }

    public function submitOrder(Request $request)
    {
        $request->validate([
            'payment_method' => 'required',
            'order_id' => 'required',
            'total' => 'required',
        ]);

        $payment_method = $request->payment_method;
        $order_id = $request->order_id;
        $total_amount = $request->total;

        if($payment_method == "cash")
        {
            $payment_types_id = 1;
        }
        else if($payment_method == "card")
        {
            $payment_types_id = 2;
        }
        else if($payment_method == "credit")
        {
            $payment_types_id = 3;
        }

        $result = Orders::where('id', $order_id)
                        ->update([
                            'payment_types_id' => $payment_types_id,
                            ]);

        $order_details = Orders::where('id', $order_id)->first();
        $customer_id = $order_details['customers_id'];
        
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
            $customer_settlement['orders_id'] = $order_id;
            $customer_settlement['credit_amount'] = $total_amount;
            $customer_settlement['balance_amount'] = $balance_amount;
            $customer_settlement['date'] = date("Y-m-d");

            $result2 = Customer_Settlements::create($customer_settlement);
        }

        if($result || $result2)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
}