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
use App\Models\ReservationTimes;
use App\Models\Tables_has_Reservation_Times;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TableBookingController extends Controller
{
    public function fetchAllTables()
    {
        return Tables::where('active', 1)->where('deleted', 0)->get();
    }

    public function fetchAllReservationTimes()
    {
        return ReservationTimes::where('active', 1)->where('deleted', 0)->get();
    }

    public function fetchBookedReservations(Request $request)
    {
        $request->validate([
            'table_id' => 'required',
            'date' => 'required',
        ]);

        $table_id = $request->table_id;
        $today = date("Y-m-d");
        $current_date = $request->date;

        $reservation_times = ReservationTimes::where('active', 1)->where('deleted', 0)->get();

        foreach($reservation_times as $reservation_time)
        {
            $reservations = Tables_has_Reservation_Times::where('tables_id', $table_id)->where('reservation_times_id', $reservation_time['id'])->where('active', 1)->where('deleted', 0)->where('created_at', 'like', $current_date . '%')->first();
            $reservation_time['reservations'] = $reservations['reservation'];
        }
        if($today != $current_date)
        {
            $reservation_times['disable_buttons'] = 1;
        }
        else
        {
            $reservation_times['disable_buttons'] = 0;
        }

        return $reservation_times;
    }

    public function clearReservation(Request $request){

        $request->validate([
            'table_id' => 'required',
            'reservation_id' => 'required'
        ]);

        try{

            $table_id = $request->table_id;
            $reservation_id = $request->reservation_id;
            $current_date = date("Y-m-d");

            $clear_reservation = Tables_has_Reservation_Times::where('tables_id', $table_id)->where('reservation_times_id', $reservation_id)->where('created_at', 'like', $current_date . '%')->delete();


            if($clear_reservation){
                return 1;
            }else{
                return 0;
            }

        }catch(Exception $e){
            return $e;
        }

    }

    public function createReservation(Request $request)
    {
        $request->validate([
            'table_id' => 'required',
            'reservation' => 'required',
            'reservation_id' => 'required'
        ]);

        $table_id = $request->table_id;
        $reservation_id = $request->reservation_id;
        $reservation = $request->reservation;
        $current_date = date("Y-m-d");

        $already_have = Tables_has_Reservation_Times::where('tables_id', $table_id)->where('reservation_times_id', $reservation_id)->where('active', 1)->where('deleted', 0)->where('created_at', 'like', $current_date . '%')->get();

        if(count($already_have) == 0)
        {
            $add_reservation['tables_id'] = $table_id;
            $add_reservation['reservation_times_id'] = $reservation_id;
            $add_reservation['reservation'] = $reservation;

            $result = Tables_has_Reservation_Times::create($add_reservation);

            if($result)
            {
                return 1;
            }
        }
        else 
        {
            $reservation_update = Tables_has_Reservation_Times::where('tables_id', $table_id)->where('reservation_times_id', $reservation_id)->clearReservationwhere('created_at', 'like', $current_date . '%')
                                ->update([
                                    'reservation' => $reservation
                                    ]);

            if($reservation_update)
            {
                return 1;
            }

        }
    }
}