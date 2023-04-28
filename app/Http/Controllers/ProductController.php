<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    //
    public function storeProductItem(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
        'name'=>'required|max:100',
        ]);

    if($validator->fails())
    {
        return response()->json([
            'validate_err'=> $validator->getMessageBag(),

        ]);
    } else {
            $Product = new Product;
            if ($request->hasFile('image_one')) {
                $image = $request->file('image_one');
                $filename = Str::random(32) . "." . $image->getClientOriginalExtension();
                $image->move('products/', $filename);
                $Product->image_one = $filename;
            }

            if ($request->hasFile('image_two')) {
                $image1 = $request->file('image_two');
                $filename1 = Str::random(32) . "." . $image1->getClientOriginalExtension();
                $image1->move('products/', $filename1);
                $Product->image_two = $filename1;
            }

            $Product->name = $request->input('name');
            $Product->description = $request->input('description');
            $Product->price = $request->input('price');
            $Product->category_name = $request->input('category_name');
            $Product->user_id = $request->input('user_id');
            $Product->quantity = $request->input('quantity');
            $Product->discount = $request->input('discount');
            $Product->new_old = $request->input('old_new');
            $Product->subcategory_name = $request->input('subcategory');
            $Product->save();

            return response()->json([
                'status'=> 200,
                'message'=> "successfully added product",
                'products'=> $Product,
            ]);
        }
    }

    public function getAllProductItems()
    {

        $Product = DB::table('product')
        ->join('product_categories','product.category_name',"=",'product_categories.name')
        ->select('*', 'product.id as rid','product_categories.name as pn', 'product_categories.description as pd', 'product.name as name','product_categories.id as pid')
        ->get();

        return response()->json([
            'status'=> 200,
            'Products'=> $Product
        ]);
    }

    public function getAllProductItemsReal()
    {

        $Product = Product::all();

        return response()->json([
            'status'=> 200,
            'Products'=> $Product
        ]);
    }

    public function getSingleProductItem($id)
    {
        $Product = DB::table('product')
        ->join('product_categories','product.category_name',"=",'product_categories.name')
        ->join('dineusers','product.user_id',"=",'dineusers.id')
        ->join('product_sub_categories','product_categories.id',"=",'product_sub_categories.category_id')
        ->select('*', 'product.id as rid','product_categories.name as pn', 'product_categories.description as pd', 'product.name as name','product_categories.id as pid', 'dineusers.id as did', 'product_sub_categories.name as psn', 'product.description as decri', 'dineusers.image as dimage')
        ->where('product.id','=',$id)
        ->get();

        if($Product)
        {
            return response()->json([
                'status'=> 200,
                'info'=>$Product
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message'=> 'No record with such id found!',
            ]);
        }
    }

    public function getSingleProductItemWithCategory($name) {
        $Product = Product::where('category_name', '=', $name)->get();

        if($Product)
        {
            return response()->json([
                'status'=> 200,
                'info'=>$Product
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message'=> 'No record with such id found!',
            ]);
        }
    }

    public function getAccountProducts($id)
    {
        $Product = Product::where('user_id','=',$id)->get();

        if($Product)
        {
            return response()->json([
                'status'=> 200,
                'products'=>$Product
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message'=> 'No record with such id found!',
            ]);
        }
    }

    public function getAccountSingleProducts($id)
    {
        $Product = Product::where('id','=',$id)->get();

        if($Product)
        {
            return response()->json([
                'status'=> 200,
                'products'=>$Product
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message'=> 'No record with such id found!',
            ]);
        }
    }

    public function updateProductSingleItem(Request $request, $id)
    {
        $Product = Product::where('id','=', $id)->first();
        if($Product)
        {

            if($request->hasFile('image_one'))
            {
                $path = 'icons/'.$Product->image_one;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('image_one');
                $filename = Str::random(32) . "." . $image->getClientOriginalExtension();
                $image->move('products/', $filename);
                $Product->image_one = $filename;
            }

            if($request->hasFile('image_two'))
            {
                $path = 'icons/'.$Product->image_two;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image1 = $request->file('image_two');
                $filename1 = Str::random(32) . "." . $image1->getClientOriginalExtension();
                $image1->move('products/', $filename1);
                $Product->image_two = $filename1;
            }

            $Product->name = $request->input('name');
            $Product->description = $request->input('description');
            $Product->price = $request->input('price');
            $Product->category_name = $request->input('category_name');
            $Product->user_id = $request->input('user_id');
            $Product->quantity = $request->input('quantity');
            $Product->discount = $request->input('discount');
            $Product->new_old = $request->input('old_new');
            $Product->subcategory_name = $request->input('subcategory');
            $Product->update();

            return response()->json([
                'status' => 200,
                'message' => "successfully added product",
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message'=> 'No record with such id found!',
            ]);
        }
    }

    public function deleteProductSingleItem($id)
    {
        $Product = Product::where('id','=', $id)->first();

        $path1 = 'products/'.$Product->image_one;
        if(File::exists($path1))
        {
        File::delete($path1);
        }

        $path2 = 'products/'.$Product->image_two;
        if(File::exists($path2))
        {
        File::delete($path2);
        }

        $Product->delete();

        return response()->json([
            'status'=> 200,
            'message'=>'product deleted Successfully',
        ]);
    }

    public function getSingleProductItemWithUser()
    {
        $Product = DB::table('product')
        ->join('dineusers','product.user_id',"=",'dineusers.id')
        ->select('*', 'product.id as rid','dineusers.id as di', 'product.name as pnm')
        ->get();

        return response()->json([
            'status'=> 200,
            'Products'=> $Product
        ]);
    }
}
