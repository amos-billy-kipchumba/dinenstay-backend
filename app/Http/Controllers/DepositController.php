<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    //
    public function addDeposit(Request $request)
    {
        $Deposit = new Deposit;
        $Deposit->user_id = $request->input('user_id');
        $Deposit->amount = $request->input('amount');
        $Deposit->transaction = $request->input('transaction');
        $Deposit->type = $request->input('type');
        $Deposit->save();

        return response()->json([
            'status'=> 200,
            'message'=> "successfully added Deposit",
        ]);
    }

    public function getAllUserTransaction($id)
    {
        $Deposit = Deposit::where('user_id', '=', $id)->get();

        if($Deposit)
        {
            return response()->json([
                'status'=> 200,
                'Transactions'=>$Deposit
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
