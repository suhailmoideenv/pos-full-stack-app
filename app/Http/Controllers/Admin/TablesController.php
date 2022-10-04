<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Categories;
use App\Models\Tables;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class TablesController extends Controller
{
    public function index()
    {
        return Tables::where('deleted', 0)->get();
    }

    public function store(Request $request){


        $request->validate([
            'table_name' => 'required',
            'pax_count' => 'required',
        ]);

        try{
                $table_name = $request->table_name;
                $pax_count = $request->pax_count;

                $user_id= \Session::get('user_id');

                $tables['name'] = $table_name;
                $tables['pax_count'] = $pax_count;
                $tables['users_id'] = $user_id;

                $result = Tables::create($tables);


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
            'table_name' => 'required',
            'pax_count' => 'required',
            'active' => 'required'
        ]);

        try{

        $id = $request->id;
        $table_name = $request->table_name;
        $pax_count = $request->pax_count;
        $active = $request->active;

        $table_update = Tables::where('id', $id)
                                ->update([
                                    'name' => $table_name,
                                    'pax_count' => $pax_count,
                                    'active' => $active,
                                    'updated_at' => date("Y-m-d H:i:s")
                                    ]);


            if($table_update){
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

            $table_delete = Tables::where('id', $id)
                                ->update([
                                    'deleted' => 1
                                    ]);


            if($table_delete){
                return 1;
            }else{
                return 0;
            }

        }catch(Exception $e){
            return $e;
        }

    }
}