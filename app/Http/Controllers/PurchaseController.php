<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Purchase;
use Illuminate\Support\Facades\DB;
class PurchaseController extends Controller
{
    //
    public function addPurchaseDetails(Request $request)
    {
        $Purchase = new Purchase;
        $Purchase->first_name = $request->input('first_name');
        $Purchase->last_name = $request->input('last_name');
        $Purchase->country = $request->input('country');
        $Purchase->street_address = $request->input('street_address');
        $Purchase->street_address2 = $request->input('street_address2');
        $Purchase->city = $request->input('city');
        $Purchase->state = $request->input('state');
        $Purchase->zip_code = $request->input('zip_code');
        $Purchase->total_price = $request->input('total_price');
        $Purchase->paid = "yes";
        $Purchase->mpesa_message = "sdhklklkm90";
        $Purchase->bank_message = "uieuiwn";
        $Purchase->purchase_phone = $request->input('purchase_phone');
        $Purchase->shipped = "false";
        $Purchase->received = "false";
        $Purchase->user_id = $request->input('user_id');
        $Purchase->pay_type = $request->input('pay_type');
        // $Purchase->mpesa_id = 1;
        // $Purchase->bank_id = 1;
        $Purchase->save();

        return response()->json([
            'status'=> 200,
            'message'=> "successfully added post",
            'purchase_item'=> $Purchase,
        ]);
    }


    public function getSinglePurchaseDetails($id)
    {
        $order = DB::table('order_item')->where('buyer_id','=',$id)->get();

        if($order)
        {
            return response()->json([
                'status'=> 200,
                'purchase'=>$order
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message'=> "No such record found",
            ]);
        }
    }


    public function getSellerPurchaseDetails($id)
    {
        $order = DB::table('order_item')->where('seller_id','=',$id)->get();

        if($order)
        {
            return response()->json([
                'status'=> 200,
                'purchase'=>$order
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message'=> "No such record found",
            ]);
        }
    }

    public function getAllPurchases()
    {
        $Purchase = Purchase::all();

        return response()->json([
            'status'=> 200,
            'purchase'=> $Purchase
        ]);
    }

    public function getBuyerPurchaseDetails($id)
    {
        $order = DB::table('purchase')->where('id','=',$id)->get();

        if($order)
        {
            return response()->json([
                'status'=> 200,
                'purchase'=>$order
            ]);
        }
        else
        {
            return response()->json([
                'status'=> 404,
                'message'=> "No such record found",
            ]);
        }
    }

    public function updateSinglePurchaseDetailsShipped($id)
    {

        $Purchase = Purchase::where('id', $id)->first();
        if($Purchase)
        {
            $Purchase->shipped = "true";
            $Purchase->update();

            return response()->json([
                'status'=> 200,
                'message'=> 'Purchase details updated successfully',
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

    public function updateSinglePurchaseDetailsReceived($id)
    {

        $Purchase = Purchase::where('id', $id)->first();
        if($Purchase)
        {
            $Purchase->received = "true";
            $Purchase->update();

            return response()->json([
                'status'=> 200,
                'message'=> 'Purchase details updated successfully',
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
}
