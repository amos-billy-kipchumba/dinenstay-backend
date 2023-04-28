<?php

namespace App\Http\Controllers;

use App\Models\ProductSubCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Facades\DB;

class ProductSubCategory extends Controller
{
    //
    public function storeProductSubcategory(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
        'name'=>'required|max:100|unique:product_sub_categories',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'validate_err'=> $validator->getMessageBag(),

            ]);
        } else {
                $ProductSubCategories = new ProductSubCategories();
                $ProductSubCategories->name = $request->input('name');
                $ProductSubCategories->category_id = $request->input('id');
                $ProductSubCategories->save();

                return response()->json([
                    'status' => 200,
                    'message' => "successfully added subcategory",
                ]);
            }
    }

    public function getAllProductSubCategory()
    {
        $ProductSubCategories = DB::table('product_sub_categories')

        ->get();

        return response()->json([
            'status'=> 200,
            'info'=> $ProductSubCategories,
        ]);
    }

    public function getProductSubCategory($id)
    {
        $ProductSubCategories = ProductSubCategories::where('category_id', '=', $id)->get();

        if($ProductSubCategories)
        {
            return response()->json([
                'status'=> 200,
                'info'=>$ProductSubCategories
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


    public function getProductSingleSubcategory($id)
    {
        $ProductSubCategories = ProductSubCategories::where('id', '=', $id)->first();

        if($ProductSubCategories)
        {
            return response()->json([
                'status'=> 200,
                'info'=>$ProductSubCategories
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



    public function updateProductSingleSubcategory(Request $request, $id)
    {
        $ProductSubCategories = ProductSubCategories::where('id', $id)->first();
        if($ProductSubCategories)
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
                $ProductSubCategories->name = $request->input('name');
                $ProductSubCategories->update();
            }

            return response()->json([
                'status'=> 200,
                'message'=> "Product Subcategory updated successfully",
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

    public function deleteProductSingleSubcategory($id)
    {
        $ProductSubCategories = ProductSubCategories::find($id);

        $ProductSubCategories->delete();

        return response()->json([
            'status'=> 200,
            'message'=>'category deleted Successfully',
        ]);
    }
}
