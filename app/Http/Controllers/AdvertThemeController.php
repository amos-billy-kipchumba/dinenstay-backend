<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdvertTheme;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
//
//
class AdvertThemeController extends Controller
{
    //
    public function addAdvertTheme(Request $request)
    {

        $AdvertTheme = new AdvertTheme;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Str::random(32) . "." . $image->getClientOriginalExtension();
            $image->move('themes/', $filename);
            $AdvertTheme->image = $filename;
        }
        $AdvertTheme->link = $request->input('link');
        $AdvertTheme->content = $request->input('content');
        $AdvertTheme->save();

        return response()->json([
            'status'=> 200,
            'message'=> "successfully added post",
            'theme'=> $AdvertTheme,
        ]);
    }

    public function getAllAdvertThemes()
    {

        $theme = AdvertTheme::all();

        return response()->json([
            'status'=>200,
            'theme'=> $theme
        ]);
    }

    public function getSingleAdvertTheme($id)
    {
        $AdvertTheme = AdvertTheme::where('id', '=', $id)->first();

        if($AdvertTheme)
        {
            return response()->json([
                'status'=> 200,
                'theme'=>$AdvertTheme
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

    public function updateSingleAdvertTheme(Request $request, $id)
    {
        $AdvertTheme = AdvertTheme::where('id','=',$id)->first();
        if($AdvertTheme)
        {
            if($request->hasFile('image'))
            {
                $path = 'themes/'.$AdvertTheme->image;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('image');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('themes/', $filename);
                $AdvertTheme->image = $filename;
            }
            $AdvertTheme->link = $request->input('link');
            $AdvertTheme->content = $request->input('content');
            $AdvertTheme->update();

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

    public function deleteSingleAdvertTheme($id)
    {
        $AdvertTheme = AdvertTheme::find($id);

        $path1 = 'themes/'.$AdvertTheme->image;
        if(File::exists($path1))
        {
        File::delete($path1);
        }

        $AdvertTheme->delete();

        return response()->json([
            'status'=> 200,
            'message'=>'category deleted Successfully',
        ]);
    }
}
