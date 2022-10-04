<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Customers;
use App\Models\Drivers;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\Items;
use App\Models\Driver_Settlements;
use App\Models\Categories;
use App\Models\OrderTypes;

class DashboardController extends Controller
{
    public function index(){

        return view('admin.dashboard.index');
    }

    public function startSession()
    {
        $id = Auth::user()->id;
        \Session::put('user_id',$id);
        return $user_id= \Session::get('user_id');
    }

    public function getAllCustomers()
    {
        return $customer_count = Customers::where('deleted', 0)->count();
    }

    public function getLastWeekCustomerPercentage()
    {
        $date = date('Y-m-d', strtotime('-7 days'));
        $customer_count = Customers::where('deleted', 0)->count();
        $last_week_customer_count = Customers::where('created_at', '>=', $date)->where('deleted', 0)->count();

        return $percentage = ($last_week_customer_count/$customer_count) * 100;
        
    }

    public function getLastMonthCustomerPercentage()
    {
        $starting_date = date("Y-n-j", strtotime("first day of previous month"));
        $end_date = date("Y-n-j", strtotime("last day of previous month"));

        $customer_count = Customers::where('deleted', 0)->count();
        $last_month_customer_count = Customers::where('created_at', '>=', $starting_date)->where('created_at', '<=', $end_date)->where('deleted', 0)->count();

        return $percentage = ($last_month_customer_count/$customer_count) * 100;
        
    }

    public function getLatestCustomer()
    {
        $customer = Customers::select('name')->orderBy('created_at', 'DESC')->where('deleted', 0)->first();
        return $customer['name'];
    }

    public function getAllOrderTotal()
    {
        $order_total = Orders::sum('subtotal');
        return number_format((float)$order_total, 2, '.', '');
    }

    public function getTodayIncome()
    {
        $date = date('Y-m-d');
        $order_total = Orders::where('created_at', 'like', $date.'%')->sum('subtotal');
        return number_format((float)$order_total, 2, '.', '');
    }

    public function getLastWeekOrderPercentage()
    {
        $date = date('Y-m-d', strtotime('-7 days'));
        $order_total = Orders::sum('subtotal');
        $last_week_order_total = Orders::where('created_at', '>=', $date)->sum('subtotal');

        $percentage = ($last_week_order_total/$order_total) * 100;
        return number_format((float)$percentage, 2, '.', '');
    }

    public function getLastMonthOrderPercentage()
    {
        $starting_date = date("Y-n-j", strtotime("first day of previous month"));
        $end_date = date("Y-n-j", strtotime("last day of previous month"));

        $order_total = Orders::sum('subtotal');
        $last_week_order_total = Orders::where('created_at', '>=', $starting_date)->where('created_at', '<=', $end_date)->sum('subtotal');

        $percentage = ($last_week_order_total/$order_total) * 100;
        return number_format((float)$percentage, 2, '.', '');
    }

    public function getAllDrivers()
    {
        return $driver_count = Drivers::where('deleted', 0)->count();
    }

    public function getLastWeekDriverPercentage()
    {
        $date = date('Y-m-d', strtotime('-7 days'));
        $driver_count = Drivers::where('deleted', 0)->count();
        $last_week_driver_count = Drivers::where('created_at', '>=', $date)->where('deleted', 0)->count();

        return $percentage = ($last_week_driver_count/$driver_count) * 100;
        
    }

    public function getLastMonthDriverPercentage()
    {
        $starting_date = date("Y-n-j", strtotime("first day of previous month"));
        $end_date = date("Y-n-j", strtotime("last day of previous month"));

        $driver_count = Drivers::where('deleted', 0)->count();
        $last_month_driver_count = Drivers::where('created_at', '>=', $starting_date)->where('created_at', '<=', $end_date)->where('deleted', 0)->count();

        return $percentage = ($last_month_driver_count/$driver_count) * 100;
        
    }

    public function getLatestDriver()
    {
        $driver = Drivers::select('name')->orderBy('created_at', 'DESC')->where('deleted', 0)->first();
        return $driver['name'];
    }

    public function getAllDriverSettlements()
    {
        $driver_settlements = Driver_Settlements::sum('amount');
        return number_format((float)$driver_settlements, 2, '.', '');
    }

    public function getLatestDriverSettlements()
    {
        $latest_settlements = Driver_Settlements::orderBy('created_at', 'DESC')->limit(1)->get();

        foreach($latest_settlements as $latest_settlement)
        {
            $driver_name = Drivers::where('id', $latest_settlement['drivers_id'])->first();
            $latest_settlement['driver_name'] = $driver_name['name'];

            $text = "AED ". $latest_settlement['amount'] ." to ". $latest_settlement['driver_name'];
        }

        return $text;
    }

    public function getLastWeekSettlements()
    {
        $date = date('Y-m-d', strtotime('-7 days'));
        $driver_settlements = Driver_Settlements::where('created_at', '>=', $date)->sum('amount');
        return number_format((float)$driver_settlements, 2, '.', '');
    }

    public function getLastMonthSettlements()
    {
        $starting_date = date("Y-n-j", strtotime("first day of previous month"));
        $end_date = date("Y-n-j", strtotime("last day of previous month"));

        $driver_settlements = Driver_Settlements::where('created_at', '>=', $starting_date)->where('created_at', '<=', $end_date)->sum('amount');
        return number_format((float)$driver_settlements, 2, '.', '');
    }

    public function getDailyTargetStats()
    {
        $date = date('Y-m-d');
        $time = date("h:i:s");

        $daily_target_stats = Orders::orderBy('created_at', 'DESC')->limit(1)->get();

        foreach($daily_target_stats as $daily_target_stat)
        {
            $daily_target_stat['target_amount'] = 1000;
            $daily_target_stat['order_total'] = Orders::where('created_at', $date)->sum('subtotal');
            $daily_target_stat['to_earn'] = $daily_target_stat['target_amount'] - $daily_target_stat['order_total'];
            $daily_target_stat['target_percentage_style'] = "width: ". ($daily_target_stat['order_total']/$daily_target_stat['target_amount']) * 100 ."%";
            $daily_target_percentage = ($daily_target_stat['order_total']/$daily_target_stat['target_amount']) * 100;
            $daily_target_stat['target_percentage'] = number_format((float)$daily_target_percentage, 2, '.', '');

            $interval = $daily_target_stat['created_at']->diff($time);
            $daily_target_stat['last_updated'] = $interval->format('%h')." Hours ".$interval->format('%i');

        }

        return $daily_target_stats;
    }

    public function getMonthlyTargetStats()
    {
        $date = date('Y-m-d');
        $time = date("h:i:s");

        $starting_date = date("Y-n-j", strtotime("first day of previous month"));
        $end_date = date("Y-n-j", strtotime("last day of previous month"));

        $monthly_target_stats = Orders::where('created_at', '>=', $starting_date)->where('created_at', '<=', $end_date)->orderBy('created_at', 'DESC')->limit(1)->get();

        foreach($monthly_target_stats as $monthly_target_stat)
        {
            $monthly_target_stat['target_amount'] = 100000;
            $monthly_target_stat['order_total'] = Orders::where('created_at', '>=', $starting_date)->where('created_at', '<=', $end_date)->sum('subtotal');
            $monthly_target_stat['to_earn'] = $monthly_target_stat['target_amount'] - $monthly_target_stat['order_total'];
            $monthly_target_stat['target_percentage_style'] = "width: ". ($monthly_target_stat['order_total']/$monthly_target_stat['target_amount']) * 100 ."%";
            $monthly_target_percentage = ($monthly_target_stat['order_total']/$monthly_target_stat['target_amount']) * 100;
            $monthly_target_stat['target_percentage'] = number_format((float)$monthly_target_percentage, 2, '.', '');

            $interval = $monthly_target_stat['created_at']->diff($time);
            $monthly_target_stat['last_updated'] = $interval->format('%h')." Hours ".$interval->format('%i');

        }

        return $monthly_target_stats;
    }

    public function getAllOrdersCount()
    {
        return Orders::count();
    }

    public function getOrdersAnalytics()
    {
        $customers = Customers::get();

        foreach($customers as $customer)
        {
            $customer['orders_count'] = Orders::where('customers_id', $customer['id'])->count();
            $all_orders_count = Orders::count();
            $order_percentage = ($customer['orders_count']/$all_orders_count) * 100;
            $customer['percentage'] = number_format((float)$order_percentage, 2, '.', '');
        }

        return $customers;
    }

    public function getProductsAnalytics()
    {
        $products = Items::get();

        foreach($products as $product)
        {
            $product['product_quantity_count'] = OrderItems::where('items_id', $product['id'])->sum('quantity');
            $all_product_quantity_count = OrderItems::sum('quantity');
            $quantity_percentage = ($product['product_quantity_count']/$all_product_quantity_count) * 100;
            $product['percentage'] = number_format((float)$quantity_percentage, 2, '.', '');
        }

        return $products;
    }

    public function getTopProducts()
    {
        $products = Items::get();

        foreach($products as $product)
        {
            $category_details = Categories::where('id', $product['categories_id'])->first();
            $product['category_name'] = $category_details['name'];
            $product['product_quantity_count'] = OrderItems::where('items_id', $product['id'])->sum('quantity');
            $product['product_revenue'] = OrderItems::where('items_id', $product['id'])->sum('price');
        }

        return $products;
    }

    public function getLastTenOrders()
    {
        $time = date("h:i:s");
        $orders = Orders::orderBy('created_at', 'DESC')->get();

        foreach($orders as $order)
        {
            $customer_details = Customers::where('id', $order['customers_id'])->first();
            $order['customer_details'] = $customer_details['name'] ." - " .$customer_details['telephone'];

            $interval = $order['created_at']->diff($time);
            $order['time_difference'] = $interval->format('%h')." Hours ".$interval->format('%i');

            $order_type_details = OrderTypes::where('id', $order['order_types_id'])->first();
            $order['order_type_name'] = $order_type_details['name'];
        }

        return $orders;
    }
}
