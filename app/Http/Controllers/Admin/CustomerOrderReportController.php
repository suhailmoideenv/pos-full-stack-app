<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customers;
use App\Models\PaymentTypes;
use App\Models\OrderTypes;
use App\Models\Orders;
use App\Models\Tables;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Facades\Session;
use App\Models\User;

class CustomerOrderReportController extends Controller
{
    public function fetchCustomerOrders()
    {
        $orders = Orders::orderBy('created_at', 'DESC')->get();

        foreach($orders as $order)
        {
            $table_details = Tables::where('id', $order['tables_id'])->first();
            $order['tables_name'] = $table_details['name'];

            $customer_details = Customers::where('id', $order['customers_id'])->first();
            $order['customer_name'] = $customer_details['name'];

            $payment_type_details = PaymentTypes::where('id', $order['payment_types_id'])->first();
            $order['payment_type'] = $payment_type_details['name'];

            $order_type_details = OrderTypes::where('id', $order['order_types_id'])->first();
            $order['order_type'] = $order_type_details['name'];

            $old_date_timestamp = strtotime($order['created_at']);
            $order['created'] = date('Y-m-d H:i:s', $old_date_timestamp);

            if($order['status'] == 0)
            {
                $order['status'] = "Pending";
            }
            else if($order['status'] == 1)
            {
                $order['status'] = "Completed";
            }
            else if($order['status'] == 2)
            {
                $order['status'] = "Cancelled";
            }
        }

        return $orders;
    }
}