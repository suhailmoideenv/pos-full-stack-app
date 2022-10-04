<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Categories;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use illuminate\Support\Facades\Session;


class CategoryController extends Controller
{
    public function index()
    {
        return Categories::where('deleted', 0)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required'
        ]);

        try
        {
            $category_name = $request->category_name;

            $user_id= \Session::get('user_id');

            $category['name'] = $category_name;
            $category['users_id'] = $user_id;

            $result = Categories::create($category);


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
            'category_name' => 'required',
            'active' => 'required'
        ]);

        try{

        $id = $request->id;
        $category_name = $request->category_name;
        $active = $request->active;

        $category_update = Categories::where('id', $id)
                                ->update([
                                    'name' => $category_name,
                                    'active' => $active,
                                    'updated_at' => date("Y-m-d H:i:s")
                                    ]);


            if($category_update){
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

            $category_delete = Categories::where('id', $id)
                                ->update([
                                    'deleted' => 1
                                    ]);


            if($category_delete){
                return 1;
            }else{
                return 0;
            }

        }catch(Exception $e){
            return $e;
        }

    }
}