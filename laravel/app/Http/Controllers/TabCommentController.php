<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Category;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Levels;
use Illuminate\Support\Facades\Hash;

class TabCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return view('dashboard.users.index',[
            'users'=> User::where("id", "!=", 1)->get(),
            ]);
    }

     /** 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


     public function create()
    {
        return view('dashboard.users.create',[
            'categories'=>Levels::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|email:dns',
            'password' => 'required|min:5|max:255',
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);
        $validatedData['level'] = 2;
        User::create($validatedData);
            return redirect('/dashboard/my-users')->with('success','New User has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        return view('dashboard.users.showusers',[
            'user'=>User::where("id", $id)->first()
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $comment)
    {
        return view('dashboard.users.edit',[
            'comment'=>$comment,
            'categories'=> Levels::all()
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $rules=[
            'slug'=>'required|max:255',
            'category_id'=>'required',
            'body'=>'required'
            ];
            if($request->slug != $comment->slug){
            $rules['slug'] = 'required|unique:comments';
            }
            $validatedData = $request->validate($rules);
            $validatedData['user_id']=auth()->user()->user_id;
            $validatedData['excerpt']=Str::limit(strip_tags($request->body), 200);
            $validatedData['tanggal_post'] = Carbon::now(); 
            Comment::where('id',$comment->id)
            ->update($validatedData);
            return redirect('/dashboard/my-users')->with('success','Comment has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        Comment::destroy($comment->id);
 return redirect('/dashboard/my-users')->with('success','Comment has been deleted!');
    }

    public function checkSlug(Request $request)
     {
        $slug = SlugService::createSlug(Comment::class,'slug',$request->username);
        return response()->json(['slug'=>$slug]);
    }

}
