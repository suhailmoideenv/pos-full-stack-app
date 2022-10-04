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


class MenuStockController extends Controller
{
    public function index()
    {
        return Items::where('deleted', 0)->get();
    }

    public function update(Request $request){

        $request->validate([
            'id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'active' => 'required'
        ]);

        try{

        $id = $request->id;
        $quantity = $request->quantity;
        $price = $request->price;
        $active = $request->active;

        if($active == "true")
        {
            $active = 1;
        }
        else if($active == "false")
        {
            $active = 0;
        }

        $item_update = Items::where('id', $id)
                            ->update([
                                'quantity' => $quantity,
                                'price' => $price,
                                'active' => $active,
                                'updated_at' => date("Y-m-d H:i:s")
                                ]);
        
            if($item_update){
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

            $item_delete = Items::where('id', $id)
                                ->update([
                                    'deleted' => 1
                                    ]);


            if($item_delete){
                return 1;
            }else{
                return 0;
            }

        }catch(Exception $e){
            return $e;
        }

    }
}