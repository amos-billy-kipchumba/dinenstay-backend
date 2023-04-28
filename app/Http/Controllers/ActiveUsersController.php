<?php

namespace App\Http\Controllers;

use App\Models\activeUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ActiveUsersController extends Controller
{
    //
    public function addActiveUser(Request $request)
    {
        $user = new activeUsers;

        $user->time = $request->input('time');
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->month = $request->input('month');
        $user->year = $request->input('year');
        $user->longitude = $request->input('longitude');
        $user->latitude = $request->input('latitude');
        $user->user_id = $request->input('user_id');
        $user->save();

        return response()->json([
            'status'=> 200,
            'message'=> 'Active user posted'
        ]);
    }

    public function getActiveUser($id)
    {
        $activeUsers = activeUsers::where('user_id', '=', $id)->first();
        if(!$activeUsers)
        {
            return response()->json([
                'status'=> 404,
                "error"=>"no such user"
            ]);
        }
        return response()->json([
            'status'=> 200,
            'user'=>$activeUsers
        ]);
    }

    public function getAllActiveUsers($year)
    {
        $activeUsers = DB::table('active_users')
        ->join('dineusers','active_users.user_id',"=",'dineusers.id')
        ->select('*', 'active_users.id as aid','dineusers.id as di')
        ->where('year', '=', $year)
        ->get();
        if(!$activeUsers)
        {
            return response()->json([
                'status'=> 404,
                "error"=>"no such user"
            ]);
        }
        return response()->json([
            'status'=> 200,
            'users'=>$activeUsers
        ]);
    }

    public function updateActiveUser(Request $request, $id)
    {
        $user = activeUsers::where('user_id', '=', $id)->first();
        if($user)
        {
            $user->time = $request->input('time');
            $user->email = $request->input('email');
            $user->username = $request->input('username');
            $user->month = $request->input('month');
            $user->year = $request->input('year');
            $user->longitude = $request->input('longitude');
            $user->latitude = $request->input('latitude');
            $user->user_id = $request->input('user_id');
            $user->save();

            return response()->json([
                'status'=> 200,
                'message'=> 'Active user updated successfully',
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
