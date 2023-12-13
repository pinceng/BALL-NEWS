<?php

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TabPostController;
use App\Http\Controllers\TabCommentController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/posts/category/{id}', function ($id) {
    return response()->json(Post::where('category_id', $id)->with('user')->latest()->get());
});
Route::post('/posts/{post:slug}', function (Post $post) {
    return response()->json($post); 
});

Route::get('/img/{kode}',function ($kode ) {
    return response()->file(storage_path('app/public/img/'.$kode));
});

Route::get('/video/{kode}',function ($kode ) {
    return response()->file(storage_path('app/public/video/'.$kode));
});