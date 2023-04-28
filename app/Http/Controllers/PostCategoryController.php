<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostCategories;

class PostCategoryController extends Controller
{
    //
    public function addPostCategory(Request $request)
    {

        $PostCategories = new PostCategories;
        $PostCategories->title = $request->input('title');
        $PostCategories->meta_title = "meta title";
        $PostCategories->content = "content";
        $PostCategories->save();

        return response()->json([
            'status' => 200,
            'message' => "successfully added post",
        ]);
    }

    public function getAllPostsCategory()
    {
        $PostCategories = PostCategories::all();

        return response()->json([
            'status'=> 200,
            'post_categories'=> $PostCategories
        ]);
    }

    public function deleteSinglePostCategory($id)
    {
        $PostCategories = PostCategories::find($id);

        $PostCategories->delete();

        return response()->json([
            'status'=> 200,
            'message'=>'blog post category deleted Successfully',
        ]);
    }
}
