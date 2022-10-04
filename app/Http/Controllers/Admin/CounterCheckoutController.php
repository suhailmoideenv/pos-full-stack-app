<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Categories;
use App\Models\Tables;
use App\Models\Orders;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class CounterCheckoutController extends Controller
{
    public function fetchAllTableDetails()
    {
        $all_table_details = Tables::where('active', 1)->where('deleted', 0)->get();

        $current_date = date("Y-m-d");

        foreach($all_table_details as $all_table_detail)
        {
            $orders_per_table = Orders::where('tables_id', $all_table_detail['id'])->where('created_at', 'like', $current_date . '%')->get();
            $all_table_detail['order_count'] = count($orders_per_table);

            $sub_totals_per_table = Orders::where('tables_id', $all_table_detail['id'])->where('created_at', 'like', $current_date . '%')->sum('subtotal');
            $all_table_detail['sub_total'] = $sub_totals_per_table;
        }

        return $all_table_details;
    }
}