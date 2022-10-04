<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Categories;
use App\Models\AddOns;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AddOnsController extends Controller
{
    public function index()
    {
        return AddOns::where('deleted', 0)->get();
    }

    public function store(Request $request){


        $request->validate([
            'add_on_name' => 'required',
            'adding_price' => 'required',
        ]);

        try{
                $add_on_name = $request->add_on_name;
                $adding_price = $request->adding_price;

                $user_id= \Session::get('user_id');

                $add_on['name'] = $add_on_name;
                $add_on['adding_price'] = $adding_price;
                $add_on['users_id'] = $user_id;

                $result = AddOns::create($add_on);


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
            'add_on_name' => 'required',
            'adding_price' => 'required',
            'active' => 'required'
        ]);

        try{

        $id = $request->id;
        $add_on_name = $request->add_on_name;
        $adding_price = $request->adding_price;
        $active = $request->active;

        $add_on_update = AddOns::where('id', $id)
                                ->update([
                                    'name' => $add_on_name,
                                    'adding_price' => $adding_price,
                                    'active' => $active,
                                    'updated_at' => date("Y-m-d H:i:s")
                                    ]);


            if($add_on_update){
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

            $add_on_delete = AddOns::where('id', $id)
                                ->update([
                                    'deleted' => 1
                                    ]);


            if($add_on_delete){
                return 1;
            }else{
                return 0;
            }

        }catch(Exception $e){
            return $e;
        }

    }
}