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


class ItemController extends Controller
{
    public function index()
    {
        return Items::where('deleted', 0)->get();
    }

    public function fetchCategories()
    {
        return Categories::where('deleted', 0)->get();
    }

    public function store(Request $request){


        $request->validate([
            'category_id' => 'required',
            'item_name' => 'required',
            'item_quantity' => 'required',
            'item_price' => 'required',
            'item_description' => 'required',
            'image' => 'required|string|image64:jpeg,jpg,png'
        ]);

        try{
                $category_id = $request->category_id;
                $item_name = $request->item_name;
                $item_quantity = $request->item_quantity;
                $item_price = $request->item_price;
                $item_description = $request->item_description;
                $image = $request->image;

                $user_id= \Session::get('user_id');

                $imageData = $request->image;
                $data = substr($imageData, strpos($imageData, ',') + 1);
                $data = base64_decode($data);
                $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
                Storage::disk('public')->put("/items/".$fileName , $data);

                $item['name'] = $item_name;
                $item['description'] = $item_description;
                $item['quantity'] = $item_quantity;
                $item['price'] = $item_price;
                $item['image'] = $fileName;
                $item['categories_id'] = $category_id;
                $item['users_id'] = $user_id;

                $result = Items::create($item);


                if ($result) {
                    return 1;
                } else {
                    return 0;
                }

            } catch (Exception $ex) {
                return $ex;
            }

    }
}