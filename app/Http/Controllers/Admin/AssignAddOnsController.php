<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Categories;
use App\Models\AddOns;
use App\Models\ItemsHasAddOns;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AssignAddOnsController extends Controller
{
    public function fetchAllItems()
    {
        return Items::where('active', 1)->where('deleted', 0)->get();
    }

    public function fetchAllAddOns()
    {
        return AddOns::where('active', 1)->where('deleted', 0)->get();
    }

    public function fetchAssignedAddOns(Request $request)
    {
        $request->validate([
            'item_id' => 'required'
        ]);

        $item_id = $request->item_id;

        $all_assigned_add_ons = ItemsHasAddOns::where('deleted', 0)->where('items_id', $item_id)->get();

        foreach($all_assigned_add_ons as $all_assigned_add_on)
        {
            $add_on_name = AddOns::where('id', $all_assigned_add_on['add_ons_id'])->first();
            $all_assigned_add_on['add_on_name'] = $add_on_name['name'];
            $all_assigned_add_on['add_on_price'] = $add_on_name['adding_price'];
        }

        return $all_assigned_add_ons;
    }

    public function store(Request $request){

        $request->validate([
            'item_id' => 'required',
            'add_on_id' => 'required',
        ]);

        try{
                $item_id = $request->item_id;
                $add_on_id = $request->add_on_id;

                $user_id= \Session::get('user_id');

                $already_assigned = ItemsHasAddOns::where('deleted', 0)->where('items_id', $item_id)->where('add_ons_id', $add_on_id)->get();

                if(count($already_assigned) == 0)
                {
                    $assign_add_on['items_id'] = $item_id;
                    $assign_add_on['add_ons_id'] = $add_on_id;
                    $assign_add_on['users_id'] = $user_id;

                    $result = ItemsHasAddOns::create($assign_add_on);
                }
                else
                {
                    return "already assigned";
                }

                
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
            'item_id' => 'required',
            'add_on_id' => 'required',
            'active' => 'required'
        ]);

        try{

        $item_id = $request->item_id;
        $add_on_id = $request->add_on_id;
        $active = $request->active;

        $assigned_add_on_update = ItemsHasAddOns::where('items_id', $item_id)->where('add_ons_id', $add_on_id)
                                ->update([
                                    'active' => $active,
                                    'updated_at' => date("Y-m-d H:i:s")
                                    ]);


            if($assigned_add_on_update){
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
            'item_id' => 'required',
            'add_on_id' => 'required',
        ]);

        try{

            $item_id = $request->item_id;
            $add_on_id = $request->add_on_id;

            $assigned_add_on_delete = ItemsHasAddOns::where('items_id', $item_id)->where('add_ons_id', $add_on_id)
                                ->update([
                                    'deleted' => 1
                                    ]);


            if($assigned_add_on_delete){
                return 1;
            }else{
                return 0;
            }

        }catch(Exception $e){
            return $e;
        }

    }
}