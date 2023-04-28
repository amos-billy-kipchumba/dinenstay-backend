<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderItemController extends Controller
{
    //
    public function addOrderItem(Request $request)
    {

        $products = json_decode($request->input('products'), true);
        foreach ($products as $key => $value) {
            $OrderItem = new OrderItem();
            $OrderItem->quantity = $value['quantity'];
            $OrderItem->price = $value['price'];
            $OrderItem->purchase_id = $request->input('purchase_id');
            $OrderItem->product_id = $value['product_id'];
            $OrderItem->buyer_id = $request->input('buyer_id');
            $OrderItem->seller_id = $value['seller_id'];
            $OrderItem->save();
        }

        return response()->json([
            'status'=> 200,
            'message'=> "success"
        ]);
    }

    public function getSingleOrderItems($id)
    {
        $order = DB::table('order_item')
        ->join('purchase','order_item.purchase_id',"=",'purchase.id')
        ->join('product','order_item.product_id',"=",'product.id')
        ->select('*', 'product.id as rid', 'product.name as pn', 'product.price as pp', 'purchase.id as pi', 'order_item.id as oid', 'order_item.price as oip', 'order_item.quantity as oiq')
        ->where('order_item.purchase_id','=',$id)
        ->get();

        if($order)
        {
            return response()->json([
                'status'=> 200,
                'info'=>$order
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

    public function getAllOrderItems()
    {
        $order = DB::table('order_item')
        ->join('purchase','order_item.purchase_id',"=",'purchase.id')
        ->join('product','order_item.product_id',"=",'product.id')
        ->join('dineusers','order_item.seller_id',"=",'dineusers.id')
        ->select('*', 'product.id as rid', 'product.name as pn', 'product.price as pp', 'purchase.id as pi', 'order_item.id as oid', 'order_item.price as oip', 'order_item.quantity as oiq', 'dineusers.id as did')
        ->get();

        if($order)
        {
            return response()->json([
                'status'=> 200,
                'info'=>$order
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
