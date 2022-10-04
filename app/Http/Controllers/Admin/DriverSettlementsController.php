<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Driver_Settlements;
use App\Models\Drivers;
use Illuminate\Support\Facades\Auth;
use illuminate\Support\Facades\Session;
use App\Models\User;

class DriverSettlementsController extends Controller
{
    public function create(Request $request)
    {
        $request->validate([
            'driver_id' => 'required',
            'amount' => 'required',
            'date' => 'required'
        ]);

        $driver_id = $request->driver_id;
        $amount = $request->amount;
        $date = $request->date;

        $driver_settlement['drivers_id'] = $driver_id;
        $driver_settlement['amount'] = $amount;
        $driver_settlement['date'] = $date;

        $result = Driver_Settlements::create($driver_settlement);

        if($result)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function fetchDriverFullPayment(Request $request)
    {
        $driver_id = $request->driver_id;

        return $full_payment = Driver_Settlements::where('drivers_id', $driver_id)->sum('amount');
    }

    public function fetchDriverSettlements()
    {
        $driver_settlements = Driver_Settlements::orderBy('created_at', 'DESC')->get();

        foreach($driver_settlements as $driver_settlement)
        {
            $driver_details = Drivers::where('id', $driver_settlement['drivers_id'])->first();
            $driver_settlement['driver_name'] = $driver_details['name'];
            $old_date_timestamp = strtotime($driver_settlement['created_at']);
            $driver_settlement['created'] = date('Y-m-d H:i:s', $old_date_timestamp);
        }

        return $driver_settlements;
    }
}