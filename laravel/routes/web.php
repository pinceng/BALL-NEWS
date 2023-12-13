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
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group(['middleware' => ['auth']], function (){
    Route::get('/logout',[LoginController::class,'logout'])->name('logout');
    
    // ROUTE USE DB
    Route::get('/posts', [PostController::class,'index']);
    Route::get('/posts/{post:slug}', [PostController::class,'show']);


    Route::get('/dashboard/post/checkSlug', [TabPostController::class, 'checkSlug']);
    Route::resource('/dashboard/post',TabPostController::class);

    Route::get('/dashboard/my-users/checkSlug', [TabCommentController::class, 'checkSlug']);
    Route::resource('/dashboard/my-users',TabCommentController::class);

    
    Route::get('/logout', [LoginController::class,'logout'])->name('logout');
    Route::get('/dashboard',function() {
        return view('dashboard.index');
    });
});
Route::group(['middleware' => ['guest']],function() {
    Route::get('/login', [LoginController::class,'index'])->name('login');
    Route::get('/register', [RegisterController::class,'index']);
});



Route::post('/login', [LoginController::class,'authenticate']);
Route::post('/register', [RegisterController::class,'store']);

  