<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    //
    public function addBlogPost(Request $request)
    {

        $Posts = new Posts;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = Str::random(32) . "." . $image->getClientOriginalExtension();
            $image->move('posts/', $filename);
            $Posts->image = $filename;
        }
        $Posts->title = $request->input('title');
        $Posts->content = $request->input('description');
        $Posts->meta_title = $request->input('category');
        $Posts->user_id = $request->input('user_id');
        $Posts->save();

        return response()->json([
            'status' => 200,
            'message' => "successfully added post",
        ]);
    }

    public function getBlogPosts()
    {
        $Posts = DB::table('dineusers')
        ->join('posts','dineusers.id',"=",'posts.user_id')
        ->select('*', 'dineusers.id as did', 'dineusers.image as dineImg', 'posts.created_at as pat')
        ->get();

        return response()->json([
            'status'=> 200,
            'blog_posts'=> $Posts
        ]);
    }

    public function getPaginatedBlogPosts()
    {
        $Posts = Posts::all();

        return response()->json([
            'status'=> 200,
            'blog_posts'=> $Posts
        ]);
    }

    public function getSingleBlogPost($id) {
        $Posts = DB::table('dineusers')
        ->join('posts','dineusers.id',"=",'posts.user_id')
        ->where('posts.id','=',$id)
        ->select('*', 'dineusers.id as did', 'dineusers.image as dineImg', 'posts.created_at as pat')
        ->get();

        return response()->json([
            'status'=> 200,
            'blog_post'=> $Posts,
        ]);
    }

    public function getSingleBlogUserPost($id) {
        $Posts = Posts::where('user_id', '=', $id)->get();

        return response()->json([
            'status'=> 200,
            'blog_post'=> $Posts,
        ]);
    }

    public function updateSingleBlogPost(Request $request, $id)
    {
        $Posts = Posts::where('id', '=', $id)->first();
        if($Posts)
        {
            if($request->hasFile('image'))
            {
                $path = 'posts/'.$Posts->image;
                if(File::exists($path))
                {
                    File::delete($path);
                }
                $image = $request->file('image');
                $filename = Str::random(32).".".$image->getClientOriginalExtension();
                $image->move('posts/', $filename);
                $Posts->image = $filename;
            }


                $Posts->title = $request->input('title');
                $Posts->content = $request->input('description');
                $Posts->meta_title = $request->input('category');
                $Posts->user_id = $request->input('user_id');
                $Posts->update();

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

    public function deleteSingleBlogPost($id)
    {
        $Posts = Posts::find($id);

        $Posts->delete();

        return response()->json([
            'status'=> 200,
            'message'=>'blog post deleted Successfully',
        ]);
    }

}
