<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer_Settlements;
use App\Models\Customers;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Facades\Session;
use App\Models\User;

class CustomerSettlementsController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'customer_id' => 'required',
            'debit_amount' => 'required',
            'date' => 'required'
        ]);

        $customer_id = $request->customer_id;
        $debit_amount = $request->debit_amount;
        $date = $request->date;

        if($customer_id != null)
        {
            $last_settlement = Customer_Settlements::whereNotNull('balance_amount')->where('customers_id', $customer_id)->orderBy('date', 'DESC')->first();
            $balance_amount = $last_settlement['balance_amount'] - $debit_amount;
        }

        $customer_settlement['customers_id'] = $customer_id;
        $customer_settlement['debit_amount'] = $debit_amount;
        $customer_settlement['balance_amount'] = $balance_amount;
        $customer_settlement['date'] = $date;

        $result = Customer_Settlements::create($customer_settlement);

        if($result)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function fetchCustomerOutstanding(Request $request)
    {
        $customer_id = $request->customer_id;

        $customer_outstanding = Customer_Settlements::where('customers_id', $customer_id)->latest()->first();
        if($customer_outstanding['balance_amount'] != null)
        {
            return $customer_outstanding['balance_amount'];
        }
        else
        {
            return "null";
        }
    }

    public function fetchCustomerSettlements()
    {
        $customer_settlements = Customer_Settlements::orderBy('created_at', 'DESC')->get();

        foreach($customer_settlements as $customer_settlement)
        {
            $customer_details = Customers::where('id', $customer_settlement['customers_id'])->first();
            $customer_settlement['customer_name'] = $customer_details['name'];
            $old_date_timestamp = strtotime($customer_settlement['created_at']);
            $customer_settlement['created'] = date('Y-m-d H:i:s', $old_date_timestamp);
        }

        return $customer_settlements;
    }
}