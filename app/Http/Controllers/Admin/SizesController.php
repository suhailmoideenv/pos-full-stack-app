<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Categories;
use App\Models\Sizes;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class SizesController extends Controller
{
    public function index()
    {
        return Sizes::where('deleted', 0)->get();
    }

    public function store(Request $request){


        $request->validate([
            'size_name' => 'required',
            'adding_price' => 'required',
        ]);

        try{
                $size_name = $request->size_name;
                $adding_price = $request->adding_price;

                $user_id= \Session::get('user_id');

                $sizes['name'] = $size_name;
                $sizes['adding_price'] = $adding_price;
                $sizes['users_id'] = $user_id;

                $result = Sizes::create($sizes);


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
            'size_name' => 'required',
            'adding_price' => 'required',
            'active' => 'required'
        ]);

        try{

        $id = $request->id;
        $size_name = $request->size_name;
        $adding_price = $request->adding_price;
        $active = $request->active;

        $size_update = Sizes::where('id', $id)
                                ->update([
                                    'name' => $size_name,
                                    'adding_price' => $adding_price,
                                    'active' => $active,
                                    'updated_at' => date("Y-m-d H:i:s")
                                    ]);


            if($size_update){
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

            $size_delete = Sizes::where('id', $id)
                                ->update([
                                    'deleted' => 1
                                    ]);


            if($size_delete){
                return 1;
            }else{
                return 0;
            }

        }catch(Exception $e){
            return $e;
        }

    }
}