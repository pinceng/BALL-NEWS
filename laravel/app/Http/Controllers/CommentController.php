<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index (){
        return view('comments', [
            "title" => "Comment",
            "active"=>'Comment',
            "comments" =>Comment::latest()->filter(request(['search']))->paginate(2)->withQueryString()
        ]);
    }

    public function show(Comment $Comment){
        // dd(post::find($slug));
        return view ('comment',[
            "title" =>"Single Comment",
            "comment" => $Comment
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
