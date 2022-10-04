<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Items;
use App\Models\Categories;
use App\Models\Sizes;
use App\Models\ItemsHasSizes;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AssignSizesController extends Controller
{
    public function fetchAllItems()
    {
        return Items::where('active', 1)->where('deleted', 0)->get();
    }

    public function fetchAllSizes()
    {
        return Sizes::where('active', 1)->where('deleted', 0)->get();
    }

    public function fetchAssignedSizes(Request $request)
    {
        $request->validate([
            'item_id' => 'required'
        ]);

        $item_id = $request->item_id;

        $all_assigned_sizes = ItemsHasSizes::where('deleted', 0)->where('items_id', $item_id)->get();

        foreach($all_assigned_sizes as $all_assigned_size)
        {
            $size_name = Sizes::where('id', $all_assigned_size['sizes_id'])->first();
            $all_assigned_size['size_name'] = $size_name['name'];
            $all_assigned_size['size_price'] = $size_name['adding_price'];
        }

        return $all_assigned_sizes;
    }

    public function store(Request $request){

        $request->validate([
            'item_id' => 'required',
            'size_id' => 'required',
        ]);

        try{
                $item_id = $request->item_id;
                $size_id = $request->size_id;

                $user_id= \Session::get('user_id');

                $already_assigned = ItemsHasSizes::where('deleted', 0)->where('items_id', $item_id)->where('sizes_id', $size_id)->get();

                if(count($already_assigned) == 0)
                {
                    $assign_size['items_id'] = $item_id;
                    $assign_size['sizes_id'] = $size_id;
                    $assign_size['users_id'] = $user_id;

                    $result = ItemsHasSizes::create($assign_size);
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
            'size_id' => 'required',
            'active' => 'required'
        ]);

        try{

        $item_id = $request->item_id;
        $size_id = $request->size_id;
        $active = $request->active;

        $assigned_size_update = ItemsHasSizes::where('items_id', $item_id)->where('sizes_id', $size_id)
                                ->update([
                                    'active' => $active,
                                    'updated_at' => date("Y-m-d H:i:s")
                                    ]);


            if($assigned_size_update){
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
            'size_id' => 'required',
        ]);

        try{

            $item_id = $request->item_id;
            $size_id = $request->size_id;

            $assigned_size_delete = ItemsHasSizes::where('items_id', $item_id)->where('sizes_id', $size_id)
                                ->update([
                                    'deleted' => 1
                                    ]);


            if($assigned_size_delete){
                return 1;
            }else{
                return 0;
            }

        }catch(Exception $e){
            return $e;
        }

    }
}