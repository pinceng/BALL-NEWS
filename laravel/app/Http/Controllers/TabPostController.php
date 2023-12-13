<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class TabPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.post.index',[
            'posts'=> Post::where('user_id', auth()->user()->id)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.post.create',[
            'categories'=>Category::all()
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
        $validatedData=$request->validate([
            'title'=>'required|max:255',
            'slug'=>'required|unique:posts',
            'category_id'=>'required',
            'body'=>'required',
            'image' => ['file', 'image', 'max:3000'],
            'video' => ['file',]

        ]);


        $validatedData['image'] = $request->file("image")->store("img");
        $validatedData['video'] = $request->file("video")->store("video");


        $validatedData['user_id']=auth()->user()->id;
        $validatedData['excerpt']=Str::limit(strip_tags($request->body), 200);
        Post::create($validatedData);
        return redirect('/dashboard/post')->with('success','New News has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('dashboard.post.showpost',[
            'post'=>$post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('dashboard.post.edit',[
            'post'=>$post,
            'categories'=>Category::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $rules=[
            'title'=>'required|max:255',
            'category_id'=>'required',
            'body'=>'required'
        ];
        if($request->slug != $post->slug){
            $rules['slug'] = 'required|unique:posts';
        }
        $validatedData = $request->validate($rules);
        $validatedData['user_id']=auth()->user()->id;
        $validatedData['excerpt']=Str::limit(strip_tags($request->body), 200);

        if ( request()->file("image") ) {
            $image = Post::select("image")->where("id", $post->id)->first()['image'];

            Storage::delete($image);

            $validatedData['image'] = $request->file("image")->store('img');
        }

        if ( request()->file("video") ) {
            $image = Post::select("video")->where("id", $post->id)->first()['video'];

            Storage::delete($image);

            $validatedData['video'] = $request->file("video")->store('video');
        }


        Post::where('id',$post->id)
        ->update($validatedData);
        return redirect('/dashboard/post')->with('success','News has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {

        $image = Post::select("image")->where("id", $post->id)->first()['image'];

        Storage::delete($image);

        $image = Post::select("video")->where("id", $post->id)->first()['video'];

        Storage::delete($image);


        Post::destroy($post->id);
        return redirect('/dashboard/post')->with('success','News has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Post::class,'slug',$request->title);
        return response()->json(['slug'=>$slug]);
    }

}
