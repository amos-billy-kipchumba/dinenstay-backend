<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Target;

class TargetController extends Controller
{
    //
    public function addTarget(Request $request)
    {
        $Target = new Target;
        $Target->user_id = $request->input('user_id');
        $Target->amount = $request->input('amount');
        $Target->save();

        return response()->json([
            'status'=> 200,
            'message'=> "successfully added target",
        ]);
    }

    public function getSingleTarget($id)
    {
        $Target = Target::where('user_id', '=',  $id)->get();

        if($Target)
        {
            return response()->json([
                'status'=> 200,
                'Target'=>$Target
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

    public function updateSingleTarget(Request $request, $id)
    {
        $Target = Target::where('user_id', '=', $id)->first();
        if($Target)
        {

            $Target->amount = $request->input('amount');
            $Target->user_id = $request->input('user_id');
            $Target->update();
            return response()->json([
                'status'=> 200,
                'Target'=> "Target updated successfully",
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
