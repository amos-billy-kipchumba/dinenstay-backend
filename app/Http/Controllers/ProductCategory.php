<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategories;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductCategory extends Controller
{
    //

    public function storeProductCategory(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
        'name'=>'required|max:100|unique:product_categories',
        ]);

    if($validator->fails())
    {
        return response()->json([
            'validate_err'=> $validator->getMessageBag(),

        ]);
    } else {
            $ProductCategories = new ProductCategories;
            if ($request->hasFile('category_icon')) {
                $image = $request->file('category_icon');
                $filename = Str::random(32) . "." . $image->getClientOriginalExtension();
                $image->move('icons/', $filename);
                $ProductCategories->icon = $filename;
            }
            $ProductCategories->name = $request->input('name');
            $ProductCategories->description = $request->input('category_detail');
            $ProductCategories->save();

            return response()->json([
                'status'=> 200,
                'message'=> "successfully added category",
                'category'=> $ProductCategories,
            ]);
        }
    }

    public function getProductCategory()
    {
        $ProductCategories = ProductCategories::all();

        return response()->json([
            'status'=> 200,
            'product_category'=> $ProductCategories
        ]);
    }


    public function getProductSingleCategory($id)
    {
        $ProductCategories = ProductCategories::where('id', '=', $id)->first();

        if($ProductCategories)
        {
            return response()->json([
                'status'=> 200,
                'info'=>$ProductCategories
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

    public function updateProductSingleCategory(Request $request, $id)
    {
        $ProductCategories = ProductCategories::where('id', $id)->first();
        if($ProductCategories)
        {
            if($request->hasFile('icon'))
            {
                $path = 'icons/'.$ProductCategories->icon;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('icon');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('icons/', $filename);
                $ProductCategories->icon = $filename;
            }

            $validator = FacadesValidator::make($request->all(), [
                'name'=>'required|max:191',
                ]);

            if($validator->fails())
            {
                return response()->json([
                    'validate_err'=> $validator->getMessageBag(),

                ]);
            } else {
                $ProductCategories->name = $request->input('name');
                $ProductCategories->description = $request->input('description');
                $ProductCategories->update();
            }

            return response()->json([
                'status'=> 200,
                'message'=> "house details updated successfully",
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

    public function deleteProductSingleCategory($id)
    {
        $ProductCategories = ProductCategories::find($id);

        $path1 = 'icons/'.$ProductCategories->icon;
        if(File::exists($path1))
        {
        File::delete($path1);
        }

        $ProductCategories->delete();

        return response()->json([
            'status'=> 200,
            'message'=>'category deleted Successfully',
        ]);
    }
}
