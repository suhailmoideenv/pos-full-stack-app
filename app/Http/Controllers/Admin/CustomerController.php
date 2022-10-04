<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Customers;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use illuminate\Support\Facades\Session;


class CustomerController extends Controller
{
    public function index()
    {
        return Customers::where('deleted', 0)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'customer_tele' => 'required'
        ]);

        try
        {
            $customer_name = $request->customer_name;
            $customer_tele = $request->customer_tele;
            $building_name = $request->building_name;
            $room_no = $request->room_no;
            $area = $request->area;

            $user_id= \Session::get('user_id');

            $cutomer['name'] = $customer_name;
            $cutomer['building_name'] = $building_name;
            $cutomer['room_number'] = $room_no;
            $cutomer['area'] = $area;
            $cutomer['telephone'] = $customer_tele;
            $cutomer['users_id'] = $user_id;

            $result = Customers::create($cutomer);


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
            'customer_name' => 'required',
            'customer_tele' => 'required'
        ]);

        try{

        $id = $request->id;
        $customer_name = $request->customer_name;
        $customer_tele = $request->customer_tele;
        $building_name = $request->building_name;
        $room_no = $request->room_no;
        $area = $request->area;
        $active = $request->active;

        $customer_update = Customers::where('id', $id)
                                ->update([
                                    'name' => $customer_name,
                                    'building_name' => $building_name,
                                    'room_number' => $room_no,
                                    'area' => $area,
                                    'telephone' => $customer_tele,
                                    'active' => $active,
                                    'updated_at' => date("Y-m-d H:i:s")
                                    ]);


            if($customer_update){
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

            $customer_delete = Customers::where('id', $id)
                                ->update([
                                    'deleted' => 1
                                    ]);


            if($customer_delete){
                return 1;
            }else{
                return 0;
            }

        }catch(Exception $e){
            return $e;
        }

    }
}