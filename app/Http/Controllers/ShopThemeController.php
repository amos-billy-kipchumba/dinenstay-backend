<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopTheme;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ShopThemeController extends Controller
{
    //
    public function addShopTheme(Request $request)
    {

        $ShopTheme = new ShopTheme;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Str::random(32) . "." . $image->getClientOriginalExtension();
            $image->move('themes/', $filename);
            $ShopTheme->image = $filename;
        }
        $ShopTheme->content = $request->input('content');
        $ShopTheme->save();

        return response()->json([
            'status'=> 200,
            'message'=> "successfully added post",
            'theme'=> $ShopTheme,
        ]);
    }

    public function getAllShopThemes()
    {

        $theme = ShopTheme::all();

        return response()->json([
            'status'=>200,
            'theme'=> $theme
        ]);
    }

    public function getSingleShopThemes($id)
    {
        $ShopTheme = ShopTheme::where('id', '=', $id)->first();

        if($ShopTheme)
        {
            return response()->json([
                'status'=> 200,
                'theme'=>$ShopTheme
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

    public function updateSingleShopTheme(Request $request, $id)
    {
        $ShopTheme = ShopTheme::where('id','=',$id)->first();
        if($ShopTheme)
        {
            if($request->hasFile('image'))
            {
                $path = 'themes/'.$ShopTheme->image;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('image');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('themes/', $filename);
                $ShopTheme->image = $filename;
            }
            $ShopTheme->content = $request->input('content');
            $ShopTheme->update();

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

    public function deleteSingleShopTheme($id)
    {
        $ShopTheme = ShopTheme::find($id);

        $path1 = 'themes/'.$ShopTheme->image;
        if(File::exists($path1))
        {
        File::delete($path1);
        }

        $ShopTheme->delete();

        return response()->json([
            'status'=> 200,
            'message'=>'shop theme deleted Successfully',
        ]);
    }
}
