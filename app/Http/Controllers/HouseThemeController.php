<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HouseTheme;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class HouseThemeController extends Controller
{
    //
    public function addHouseTheme(Request $request)
    {

        $HouseTheme = new HouseTheme;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Str::random(32) . "." . $image->getClientOriginalExtension();
            $image->move('themes/', $filename);
            $HouseTheme->image = $filename;
        }
        $HouseTheme->content = $request->input('content');
        $HouseTheme->save();

        return response()->json([
            'status'=> 200,
            'message'=> "successfully added post",
            'theme'=> $HouseTheme,
        ]);
    }

    public function getAllHouseThemes()
    {

        $theme = HouseTheme::all();

        return response()->json([
            'status'=>200,
            'theme'=> $theme
        ]);
    }

    public function getSingleHouseThemes($id)
    {
        $HouseTheme = HouseTheme::where('id', '=', $id)->first();

        if($HouseTheme)
        {
            return response()->json([
                'status'=> 200,
                'theme'=>$HouseTheme
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

    public function updateSingleHouseTheme(Request $request, $id)
    {
        $HouseTheme = HouseTheme::where('id','=',$id)->first();
        if($HouseTheme)
        {
            if($request->hasFile('image'))
            {
                $path = 'themes/'.$HouseTheme->image;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('image');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('themes/', $filename);
                $HouseTheme->image = $filename;
            }
            $HouseTheme->content = $request->input('content');
            $HouseTheme->update();

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

    public function deleteSingleHouseTheme($id)
    {
        $HouseTheme = HouseTheme::find($id);

        $path1 = 'themes/'.$HouseTheme->image;
        if(File::exists($path1))
        {
        File::delete($path1);
        }

        $HouseTheme->delete();

        return response()->json([
            'status'=> 200,
            'message'=>'category deleted Successfully',
        ]);
    }
}
