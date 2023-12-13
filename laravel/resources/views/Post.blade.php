@extends('layout.main')

@section('container')

<div class="card">
  <div class="card-header">
    {{$title}}
  </div>
  <div class="card-body">
    <h5 class="card-title"><?= $post->title; ?></h5>
    <p>By. {{ $post->user->name }}</p>
    <p>Category : <a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a></p>
    <div class="mb-3 mt-4">
      <div class="card">
        <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" id="image" alt="...">
      </div>
    </div>
    {!! $post->body!!}<br>

    <a href="../posts" class="btn btn-primary mt-3">Back To Posts</a>
  </div>
</div>
<br>
@endsection
