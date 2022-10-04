<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/storage/items/{extra}', function ($extra) {return redirect("/POSWeb/storage/app/public/items/$extra");})->where('extra', '.*');

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::post('/logout',[App\Http\Controllers\Admin\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/bill', [App\Http\Controllers\Admin\CustomerOrderController::class, 'generateBill']);

Route::prefix('/admin')->name('admin.')->group(function(){
    //All the admin routes will be defined here...

    
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard/startSession', [App\Http\Controllers\Admin\DashboardController::class, 'startSession']);
        Route::get('/dashboard/getAllCustomers', [App\Http\Controllers\Admin\DashboardController::class, 'getAllCustomers']);
        Route::get('/dashboard/getLastWeekCustomerPercentage', [App\Http\Controllers\Admin\DashboardController::class, 'getLastWeekCustomerPercentage']);
        Route::get('/dashboard/getLastMonthCustomerPercentage', [App\Http\Controllers\Admin\DashboardController::class, 'getLastMonthCustomerPercentage']);
        Route::get('/dashboard/getLatestCustomer', [App\Http\Controllers\Admin\DashboardController::class, 'getLatestCustomer']);
        Route::get('/dashboard/getAllOrderTotal', [App\Http\Controllers\Admin\DashboardController::class, 'getAllOrderTotal']);
        Route::get('/dashboard/getTodayIncome', [App\Http\Controllers\Admin\DashboardController::class, 'getTodayIncome']);
        Route::get('/dashboard/getLastWeekOrderPercentage', [App\Http\Controllers\Admin\DashboardController::class, 'getLastWeekOrderPercentage']);
        Route::get('/dashboard/getLastMonthOrderPercentage', [App\Http\Controllers\Admin\DashboardController::class, 'getLastMonthOrderPercentage']);
        Route::get('/dashboard/getAllDrivers', [App\Http\Controllers\Admin\DashboardController::class, 'getAllDrivers']);
        Route::get('/dashboard/getLastWeekDriverPercentage', [App\Http\Controllers\Admin\DashboardController::class, 'getLastWeekDriverPercentage']);
        Route::get('/dashboard/getLastMonthDriverPercentage', [App\Http\Controllers\Admin\DashboardController::class, 'getLastMonthDriverPercentage']);
        Route::get('/dashboard/getLatestDriver', [App\Http\Controllers\Admin\DashboardController::class, 'getLatestDriver']);
        Route::get('/dashboard/getAllDriverSettlements', [App\Http\Controllers\Admin\DashboardController::class, 'getAllDriverSettlements']);
        Route::get('/dashboard/getLatestDriverSettlements', [App\Http\Controllers\Admin\DashboardController::class, 'getLatestDriverSettlements']);
        Route::get('/dashboard/getLastWeekSettlements', [App\Http\Controllers\Admin\DashboardController::class, 'getLastWeekSettlements']);
        Route::get('/dashboard/getLastMonthSettlements', [App\Http\Controllers\Admin\DashboardController::class, 'getLastMonthSettlements']);
        Route::get('/dashboard/getDailyTargetStats', [App\Http\Controllers\Admin\DashboardController::class, 'getDailyTargetStats']);
        Route::get('/dashboard/getMonthlyTargetStats', [App\Http\Controllers\Admin\DashboardController::class, 'getMonthlyTargetStats']);
        Route::get('/dashboard/getAllOrdersCount', [App\Http\Controllers\Admin\DashboardController::class, 'getAllOrdersCount']);
        Route::get('/dashboard/getOrdersAnalytics', [App\Http\Controllers\Admin\DashboardController::class, 'getOrdersAnalytics']);
        Route::get('/dashboard/getProductsAnalytics', [App\Http\Controllers\Admin\DashboardController::class, 'getProductsAnalytics']);
        Route::get('/dashboard/getTopProducts', [App\Http\Controllers\Admin\DashboardController::class, 'getTopProducts']);
        Route::get('/dashboard/getLastTenOrders', [App\Http\Controllers\Admin\DashboardController::class, 'getLastTenOrders']);

        Route::get('/fetch/admin', [App\Http\Controllers\Admin\AdminUserController::class, 'index']);
        Route::post('/create/admin', [App\Http\Controllers\Admin\AdminUserController::class, 'store']);
        Route::delete('/delete/admin/{id}', [App\Http\Controllers\Admin\AdminUserController::class, 'delete']);
        Route::put('/update/admin', [App\Http\Controllers\Admin\AdminUserController::class, 'update']);
        Route::post('/destroy/admin', [App\Http\Controllers\Admin\AdminUserController::class, 'destroy']);

        Route::get('/fetch/categories', [App\Http\Controllers\Admin\CategoryController::class, 'index']);
        Route::post('/create/categories', [App\Http\Controllers\Admin\CategoryController::class, 'store']);
        Route::put('/update/categories', [App\Http\Controllers\Admin\CategoryController::class, 'update']);
        Route::post('/destroy/categories', [App\Http\Controllers\Admin\CategoryController::class, 'destroy']);

        Route::get('/fetch/items-getcategories', [App\Http\Controllers\Admin\ItemController::class, 'fetchCategories']);
        Route::post('/create/items', [App\Http\Controllers\Admin\ItemController::class, 'store']);

        Route::get('/fetch/add-ons', [App\Http\Controllers\Admin\AddOnsController::class, 'index']);
        Route::post('/create/add-ons', [App\Http\Controllers\Admin\AddOnsController::class, 'store']);
        Route::put('/update/add-ons', [App\Http\Controllers\Admin\AddOnsController::class, 'update']);
        Route::post('/destroy/add-ons', [App\Http\Controllers\Admin\AddOnsController::class, 'destroy']);

        Route::get('/fetch/all-items', [App\Http\Controllers\Admin\AssignAddOnsController::class, 'fetchAllItems']);
        Route::get('/fetch/all-add-ons', [App\Http\Controllers\Admin\AssignAddOnsController::class, 'fetchAllAddOns']);
        Route::post('/fetch/create-add-ons', [App\Http\Controllers\Admin\AssignAddOnsController::class, 'fetchAssignedAddOns']);
        Route::post('/create/create-add-ons', [App\Http\Controllers\Admin\AssignAddOnsController::class, 'store']);
        Route::put('/update/create-add-ons', [App\Http\Controllers\Admin\AssignAddOnsController::class, 'update']);
        Route::post('/destroy/create-add-ons', [App\Http\Controllers\Admin\AssignAddOnsController::class, 'destroy']);

        Route::get('/fetch/sizes', [App\Http\Controllers\Admin\SizesController::class, 'index']);
        Route::post('/create/sizes', [App\Http\Controllers\Admin\SizesController::class, 'store']);
        Route::put('/update/sizes', [App\Http\Controllers\Admin\SizesController::class, 'update']);
        Route::post('/destroy/sizes', [App\Http\Controllers\Admin\SizesController::class, 'destroy']);

        Route::get('/fetch/assign-sizes-all-items', [App\Http\Controllers\Admin\AssignSizesController::class, 'fetchAllItems']);
        Route::get('/fetch/assign-sizes-all-add-ons', [App\Http\Controllers\Admin\AssignSizesController::class, 'fetchAllSizes']);
        Route::post('/fetch/create-sizes', [App\Http\Controllers\Admin\AssignSizesController::class, 'fetchAssignedSizes']);
        Route::post('/create/create-sizes', [App\Http\Controllers\Admin\AssignSizesController::class, 'store']);
        Route::put('/update/create-sizes', [App\Http\Controllers\Admin\AssignSizesController::class, 'update']);
        Route::post('/destroy/create-sizes', [App\Http\Controllers\Admin\AssignSizesController::class, 'destroy']);

        Route::get('/fetch/tables', [App\Http\Controllers\Admin\TablesController::class, 'index']);
        Route::post('/create/tables', [App\Http\Controllers\Admin\TablesController::class, 'store']);
        Route::put('/update/tables', [App\Http\Controllers\Admin\TablesController::class, 'update']);
        Route::post('/destroy/tables', [App\Http\Controllers\Admin\TablesController::class, 'destroy']);

        Route::get('/fetch/menu-stock-items', [App\Http\Controllers\Admin\MenuStockController::class, 'index']);
        Route::put('/update/menu-stock-items', [App\Http\Controllers\Admin\MenuStockController::class, 'update']);
        Route::post('/destroy/menu-stock-items', [App\Http\Controllers\Admin\MenuStockController::class, 'destroy']);

        Route::get('/fetch/orders', [App\Http\Controllers\Admin\PendingOrderController::class, 'index']);
        Route::post('/fetch/orders-orderItems', [App\Http\Controllers\Admin\PendingOrderController::class, 'fetchOrderItems']);
        Route::post('/set/orders-setcustomer', [App\Http\Controllers\Admin\PendingOrderController::class, 'setCustomer']);
        Route::post('/set/orders-setdriver', [App\Http\Controllers\Admin\PendingOrderController::class, 'setDriver']);

        Route::post('/create/debit-payment', [App\Http\Controllers\Admin\CustomerSettlementsController::class, 'create']);
        Route::post('/fetch/customer-outstanding-amount', [App\Http\Controllers\Admin\CustomerSettlementsController::class, 'fetchCustomerOutstanding']);
        Route::get('/fetch/get-customer-settlements', [App\Http\Controllers\Admin\CustomerSettlementsController::class, 'fetchCustomerSettlements']);

        Route::post('/create/driver-settlement-payment', [App\Http\Controllers\Admin\DriverSettlementsController::class, 'create']);
        Route::post('/fetch/driver-full-payment', [App\Http\Controllers\Admin\DriverSettlementsController::class, 'fetchDriverFullPayment']);
        Route::get('/fetch/get-driver-settlements', [App\Http\Controllers\Admin\DriverSettlementsController::class, 'fetchDriverSettlements']);
        
        Route::get('/fetch/customer-orders-report', [App\Http\Controllers\Admin\CustomerOrderReportController::class, 'fetchCustomerOrders']);

        Route::get('/fetch/customer-order-categories', [App\Http\Controllers\Admin\CustomerOrderController::class, 'fetchCategories']);
        Route::get('/fetch/customer-order-all-items', [App\Http\Controllers\Admin\CustomerOrderController::class, 'fetchAllItems']);
        Route::get('/fetch/customer-order-fetch-tables', [App\Http\Controllers\Admin\CustomerOrderController::class, 'fetchTables']);
        Route::get('/fetch/customer-order-fetch-order-id', [App\Http\Controllers\Admin\CustomerOrderController::class, 'fetchOrderId']);
        Route::get('/fetch/customer-order-fetch-cart', [App\Http\Controllers\Admin\CustomerOrderController::class, 'fetchCart']);
        Route::get('/fetch/customer-order-fetch-cart-total', [App\Http\Controllers\Admin\CustomerOrderController::class, 'fetchCartTotal']);
        Route::post('/fetch/search-drivers', [App\Http\Controllers\Admin\CustomerOrderController::class, 'searchDrivers']);
        Route::post('/fetch/search-customers', [App\Http\Controllers\Admin\CustomerOrderController::class, 'searchCustomers']);
        Route::post('/fetch/customer-order-items-by-category', [App\Http\Controllers\Admin\CustomerOrderController::class, 'fetchAllItemsByCategory']);
        Route::post('/fetch/customer-order-sizes-by-item', [App\Http\Controllers\Admin\CustomerOrderController::class, 'fetchAllSizesByItem']);
        Route::post('/fetch/customer-order-add-ons-by-item', [App\Http\Controllers\Admin\CustomerOrderController::class, 'fetchAllAddOnsByItem']);
        Route::post('/fetch/customer-order-search-items', [App\Http\Controllers\Admin\CustomerOrderController::class, 'getSearchItems']);
        Route::post('/fetch/customer-order-fetch-selected-add-ons', [App\Http\Controllers\Admin\CustomerOrderController::class, 'getSelectedAddOns']);
        Route::post('/fetch/customer-order-add-to-cart', [App\Http\Controllers\Admin\CustomerOrderController::class, 'addToCart']);
        Route::put('/update/customer-order-update-cart', [App\Http\Controllers\Admin\CustomerOrderController::class, 'update']);
        Route::post('/destroy/cart-item', [App\Http\Controllers\Admin\CustomerOrderController::class, 'destroy']);
        Route::post('/submit/customer-order-submit-order', [App\Http\Controllers\Admin\CustomerOrderController::class, 'submitOrder']);
        Route::get('/fetch/data-to-bill', [App\Http\Controllers\Admin\CustomerOrderController::class, 'fetchDataToBill']);

        Route::get('/admin/fetch-pending-orders', [App\Http\Controllers\Admin\AdminPendingOrderController::class, 'index']);
        Route::post('/admin/submit-pending-orders', [App\Http\Controllers\Admin\AdminPendingOrderController::class, 'submitOrder']);

        Route::get('/fetch/pending-kitchen-orders', [App\Http\Controllers\Admin\KitchenOrderController::class, 'fetchPendingOrders']);
        Route::post('/fetch/pending-kitchen-order-details', [App\Http\Controllers\Admin\KitchenOrderController::class, 'fetchPendingOrderDetails']);
        Route::get('/fetch/completed-kitchen-orders', [App\Http\Controllers\Admin\KitchenOrderController::class, 'fetchCompletedOrders']);
        Route::post('/fetch/completed-kitchen-order-details', [App\Http\Controllers\Admin\KitchenOrderController::class, 'fetchCompletedOrderDetails']);
        Route::get('/fetch/canceled-kitchen-orders', [App\Http\Controllers\Admin\KitchenOrderController::class, 'fetchCanceledOrders']);
        Route::post('/fetch/canceled-kitchen-order-details', [App\Http\Controllers\Admin\KitchenOrderController::class, 'fetchCanceledOrderDetails']);
        Route::put('/update/kitchen-orders-complete-order-item', [App\Http\Controllers\Admin\KitchenOrderController::class, 'completeOrderItem']);
        Route::put('/update/kitchen-orders-cancel-order-item', [App\Http\Controllers\Admin\KitchenOrderController::class, 'cancelOrderItem']);
        Route::put('/update/kitchen-orders-deliver-order', [App\Http\Controllers\Admin\KitchenOrderController::class, 'deliverOrder']);
        Route::put('/update/kitchen-orders-cancel-order', [App\Http\Controllers\Admin\KitchenOrderController::class, 'cancelOrder']);
        Route::post('/fetch/data-to-bill-kitchen', [App\Http\Controllers\Admin\KitchenOrderController::class, 'fetchDataToBillKitchen']);
        
        Route::get('/fetch/counter-checkout-fetch-all-tables', [App\Http\Controllers\Admin\CounterCheckoutController::class, 'fetchAllTableDetails']);

        Route::get('/fetch/table-booking-tables', [App\Http\Controllers\Admin\TableBookingController::class, 'fetchAllTables']);
        Route::get('/fetch/table-booking-reservation-times', [App\Http\Controllers\Admin\TableBookingController::class, 'fetchAllReservationTimes']);
        Route::post('/fetch/table-booking-booked-reservation-times', [App\Http\Controllers\Admin\TableBookingController::class, 'fetchBookedReservations']);
        Route::post('/delete/table-booking', [App\Http\Controllers\Admin\TableBookingController::class, 'clearReservation']);
        Route::post('/create/table-booking', [App\Http\Controllers\Admin\TableBookingController::class, 'createReservation']);

        Route::get('/fetch/drivers', [App\Http\Controllers\Admin\DriverController::class, 'index']);
        Route::post('/create/drivers', [App\Http\Controllers\Admin\DriverController::class, 'store']);
        Route::put('/update/drivers', [App\Http\Controllers\Admin\DriverController::class, 'update']);
        Route::post('/destroy/drivers', [App\Http\Controllers\Admin\DriverController::class, 'destroy']);

        Route::get('/fetch/customers', [App\Http\Controllers\Admin\CustomerController::class, 'index']);
        Route::post('/create/customers', [App\Http\Controllers\Admin\CustomerController::class, 'store']);
        Route::put('/update/customers', [App\Http\Controllers\Admin\CustomerController::class, 'update']);
        Route::post('/destroy/customers', [App\Http\Controllers\Admin\CustomerController::class, 'destroy']);

        Route::get('/{any?}', [App\Http\Controllers\HomeController::class, 'index'])->where('any', '.*');
  });
