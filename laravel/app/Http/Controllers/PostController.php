<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index (){
        return view('posts', [
            "title" => "posts",
            "active"=>'posts',
            "posts" =>Post::latest()->filter(request(['search']))->paginate(3)->withQueryString()
        ]);
    }

    public function show(Post $Post){
        // dd(post::find($slug));
        return view ('post',[
            "title" =>"Single Post",
            "post" => $Post
        ]);
      }

// public function show($slug){
//     // dd(post::find($slug));
//     return view ('post',[
//         "title" =>"Single Post",
//         "post" => Post::find($slug)
//     ]);
//   }
}