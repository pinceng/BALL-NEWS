@extends('layout.main')
@section('container')
<div class="card">
 <div class="card-header">
 </div>
 <div class="card-body">
     <h5 class="card-title"> {{ $post->title; }}</h5>
     <small class="small"><b>Author</b> : {{ $post->user->name }}</small>
     <br />
     <a href="/dashboard/post" class="btn btn-success"><span data-feather="arrow-left"></span> Back to all posts</a>
     <a href="/dashboard/post/{{$post->slug}}/edit" class="btn btn-warning"><span data-feather="edit"></span> Edit</a>
     <form action="/dashboard/post/{{$post->slug}}" method="post" class="d-inline">
         @method('delete')
         @csrf
         <button class="btn btn-danger border-0" onclick="return confirm('Are you sure?')"><span
            data-feather="x-circle"></span> Delete</button>
        </form>
        <!-- <?= $post["body"]; ?><br><br> -->
        <br>
        {!! $post->body !!}
        <br>

        <div class="mb-3 mt-4">
            <div class="card">
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" id="image" alt="...">
            </div>
        </div>
        <br>
        <div class="mb-3 mt-4">
            <div class="card">
                <video src="{{ asset('storage/' . $post->video) }}" class="card-img-top" autoplay id="video" alt="...">
            </div>
        </div>
    </div>
</div>
<br>
@endsection