@extends('layout.main')
@section('container')
<div class="card">
   <div class="card-header">
   </div>
   <div class="card-body">
    <h5 class="card-title"> {{ $user->name }}</h5>
    <small class="small"><b>Email</b> : {{ $user->email }}</small>
    <br />
    <a href="/dashboard/my-users" class="btn btn-success"><span data-feather="arrow-left"></span> Back to all posts</a>
    <form action="/dashboard/my-users/{{$user->slug}}" method="post" class="d-inline">
       @method('delete')
       @csrf
       <button class="btn btn-danger border-0" onclick="return confirm('Are you sure?')"><span
        data-feather="x-circle"></span> Delete</button>
    </form> 
    <br />
    @foreach($user->post as $post)
    <div class="card mt-2">
      <div class="card-header">
        Author : {{ $post->user->name }}
    </div>
    <div class="card-body">
        <h5 class="card-title"><?= $post->title; ?></h5>
        <p class="card-text"><?= $post->excerpt; ?></p>
        <a href="/dashboard/post/{{$post->slug}}" class="btn btn-primary">Read More</a>
    </div>
</div>
<br>
@endForeach

</div>
</div>
<br>
@endsection