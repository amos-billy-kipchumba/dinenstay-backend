<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator as FacadesValidator;

use Illuminate\Http\Request;
use App\Models\Subcribers;
class SubscriberController extends Controller
{
    //
    public function addSubscription(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'email'=>'required|email|unique:subscriber',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'validate_err'=> $validator->getMessageBag(),

            ]);
        }
        else
        {

        $Subcribers = new Subcribers;
        $Subcribers->email = $request->input('email');
        $Subcribers->save();

        return response()->json([
            'status'=> 200,
            'message'=> "successfully added subscriber",
        ]);
        }
    }
}
