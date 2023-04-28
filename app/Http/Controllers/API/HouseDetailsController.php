<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HouseDetails;
use Illuminate\Support\Facades\Validator as FacadesValidator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Hundred;

class HouseDetailsController extends Controller
{
    //
    public function storeHouseDetails(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'houseTitle'=>'required|max:191',
            'location'=>'required|max:191',
            'price'=>'required|max:191',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status'=> 422,
                'errors'=> $validator->messages(),
            ]);
        }

        else
        {
            $HouseDetails = new HouseDetails;

            if($request->hasFile('image'))
            {
                $image = $request->file('image');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('uploads/', $filename);
            }
            $HouseDetails->cover = $filename;
            $HouseDetails->title = $request->input('houseTitle');
            $HouseDetails->description = $request->input('description');
            $HouseDetails->location = $request->input('location');
            $HouseDetails->price = $request->input('price');
            $HouseDetails->user_id = $request->input('userId');
            $HouseDetails->house_type = $request->input('house_type');
            $HouseDetails->save();

            return response()->json([
                'status'=> 200,
                'house_details_data'=> $HouseDetails,
            ]);
        }

    }

    public function getHouseDetails()
    {
        $HouseDetails = HouseDetails::all();

        return response()->json([
            'status'=> 200,
            'house_details'=> $HouseDetails
        ]);
    }

    public function getZeroDetails($id)
    {
        $HouseDetails = HouseDetails::find($id);

        if($HouseDetails)
        {
            return response()->json([
                'status'=> 200,
                'zero'=>$HouseDetails
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

    public function getHelloDetails($user_id)
    {
        $HouseDetails = HouseDetails::where('id', $user_id)->first();

        if($HouseDetails)
        {
            return response()->json([
                'status'=> 200, 'hello'=>$HouseDetails
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

    public function getMagicDetails($magic_id)
    {
        $HouseDetails = HouseDetails::where('id', $magic_id)->first();

        if($HouseDetails)
        {
            return response()->json([
                'status'=> 200, 'hello'=>$HouseDetails
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

    public function updateHouseDetails(Request $request, $user_id)
    {
        $HouseDetails = HouseDetails::where('id', $user_id)->first();
        if($HouseDetails)
        {
            if($request->hasFile('image'))
            {
                $path = 'uploads/'.$HouseDetails->cover;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('image');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('uploads/', $filename);
                $HouseDetails->cover = $filename;
            }
            $HouseDetails->title = $request->input('houseTitle');
            $HouseDetails->description = $request->input('description');
            $HouseDetails->location = $request->input('location');
            $HouseDetails->price = $request->input('price');
            $HouseDetails->user_id = $request->input('userId');
            $HouseDetails->house_type = $request->input('house_type');
            $HouseDetails->update();

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


    public function getJoinMagicDetails()
    {
        $HouseDetails = DB::table('fifty')
        ->join('house_details','fifty.house_id',"=",'house_details.id')
        ->join('seventy_five','seventy_five.house_id','=','house_details.id')
        ->get();

        return response()->json([
            'status'=> 200,
            'joinSearchDetails'=> $HouseDetails,
        ]);
    }

    public function getHostHousesDetails($user_id)
    {
        $HouseDetails = HouseDetails::where('user_id',"=",$user_id)->get();

        return response()->json([
            'status'=> 200,
            'hostHousesDetails'=> $HouseDetails,
        ]);
    }


    public function getAllHomeMoreDetails()
    {
        $getAllHouseMoreDetails = DB::table('fifty')
        ->join('house_details','fifty.house_id',"=",'house_details.id')
        ->join('seventy_five','seventy_five.house_id','=','house_details.id')
        ->join('hundred','hundred.house_id','=','house_details.id')
        ->join('nearby_services','nearby_services.house_id','=','house_details.id')
        ->join('dineusers','dineusers.id','=','house_details.user_id')
        ->select('*', 'fifty.id as fid', 'house_details.id as id', 'hundred.id as hid', 'nearby_services.id as nid', 'seventy_five.id as sid', 'dineusers.id as duid')
        ->get();

        return response()->json([
            'status'=> 200,
            'bookingInfoForHost'=> $getAllHouseMoreDetails,
        ]);
    }

    public function getAllHouseMoreDetails($id)
    {
        $getAllHouseMoreDetails = DB::table('fifty')
        ->join('house_details','fifty.house_id',"=",'house_details.id')
        ->join('seventy_five','seventy_five.house_id','=','house_details.id')
        ->join('hundred','hundred.house_id','=','house_details.id')
        ->join('nearby_services','nearby_services.house_id','=','house_details.id')
        ->where('house_details.id','=',$id)
        ->get();

        return response()->json([
            'status'=> 200,
            'bookingInfoForHost'=> $getAllHouseMoreDetails,
        ]);
    }

    public function deleteHouse($id)
    {
        $HouseDetails = HouseDetails::find($id);

        $path1 = 'uploads/'.$HouseDetails->cover;
        if(File::exists($path1))
        {
        File::delete($path1);
        }

        $Hundred = Hundred::where('house_id', '=',$id)->first();

        $path1 = 'parts/'.$Hundred->sitting_room;
        if(File::exists($path1))
        {
            File::delete($path1);
        }


        $path2 = 'parts/'.$Hundred->dinning_room;
        if(File::exists($path2))
        {
            File::delete($path2);
        }

        $path3 = 'parts/'.$Hundred->kitchen;
        if(File::exists($path3))
        {
            File::delete($path3);
        }

        $path4 = 'parts/'.$Hundred->bathroom;
        if(File::exists($path4))
        {
            File::delete($path4);
        }

        $path5 = 'parts/'.$Hundred->bedroom;
        if(File::exists($path5))
        {
            File::delete($path5);
        }

        $path6 = 'parts/'.$Hundred->swimming_pool;
        if(File::exists($path6))
        {
            File::delete($path6);
        }

        $path7 = 'parts/'.$Hundred->lake;
        if(File::exists($path7))
        {
            File::delete($path7);
        }

        $path8 = 'parts/'.$Hundred->beach;
        if(File::exists($path8))
        {
            File::delete($path8);
        }

        $path9 = 'parts/'.$Hundred->ocean_view;
        if(File::exists($path9))
        {
            File::delete($path9);
        }

        $path10 = 'parts/'.$Hundred->balcony;
        if(File::exists($path10))
        {
            File::delete($path10);
        }

        $path11 = 'parts/'.$Hundred->parking;
        if(File::exists($path11))
        {
            File::delete($path11);
        }

        $path12 = 'parts/'.$Hundred->front;
        if(File::exists($path12))
        {
            File::delete($path12);
        }

        $path13 = 'parts/'.$Hundred->right;
        if(File::exists($path13))
        {
            File::delete($path13);
        }

        $path14 = 'parts/'.$Hundred->left;
        if(File::exists($path14))
        {
            File::delete($path14);
        }

        $path15 = 'parts/'.$Hundred->back;
        if(File::exists($path15))
        {
            File::delete($path15);
        }

        $path16 = 'parts/'.$Hundred->aerial;
        if(File::exists($path16))
        {
            File::delete($path16);
        }

        $HouseDetails->delete();

        return response()->json([
            'status'=> 200,
            'message'=>"house deleted successfully",
        ]);
    }
}
