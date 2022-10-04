<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Drivers;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use illuminate\Support\Facades\Session;


class DriverController extends Controller
{
    public function index()
    {
        return Drivers::where('deleted', 0)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'driver_name' => 'required',
            'driver_email' => 'required|email',
            'driver_tele' => 'required',
            'driver_vehicle_no' => 'required',
        ]);

        try
        {
            $driver_name = $request->driver_name;
            $driver_email = $request->driver_email;
            $driver_tele = $request->driver_tele;
            $driver_vehicle_no = $request->driver_vehicle_no;

            $user_id= \Session::get('user_id');

            $driver['name'] = $driver_name;
            $driver['email'] = $driver_email;
            $driver['telephone'] = $driver_tele;
            $driver['vehicle_no'] = $driver_vehicle_no;
            $driver['users_id'] = $user_id;

            $result = Drivers::create($driver);


            if ($result) {
                return 1;
            } else {
                return 0;
            }

        } catch (Exception $ex) {
            return $ex;
        }
    }

    public function update(Request $request){

        $request->validate([
            'id' => 'required',
            'driver_name' => 'required',
            'driver_email' => 'required|email',
            'driver_tele' => 'required',
            'driver_vehicle_no' => 'required',
            'active' => 'required'
        ]);

        try{

        $id = $request->id;
        $driver_name = $request->driver_name;
        $driver_email = $request->driver_email;
        $driver_tele = $request->driver_tele;
        $driver_vehicle_no = $request->driver_vehicle_no;
        $active = $request->active;

        $driver_update = Drivers::where('id', $id)
                                ->update([
                                    'name' => $driver_name,
                                    'email' => $driver_email,
                                    'telephone' => $driver_tele,
                                    'vehicle_no' => $driver_vehicle_no,
                                    'active' => $active,
                                    'updated_at' => date("Y-m-d H:i:s")
                                    ]);


            if($driver_update){
                return 1;
            }else{
                return 0;
            }

        }catch(Exception $e){
            return $e;
        }

    }

    public function destroy(Request $request){

        $request->validate([
            'id' => 'required'
        ]);

        try{

            $id = $request->id;

            $driver_delete = Drivers::where('id', $id)
                                ->update([
                                    'deleted' => 1
                                    ]);


            if($driver_delete){
                return 1;
            }else{
                return 0;
            }

        }catch(Exception $e){
            return $e;
        }

    }
}