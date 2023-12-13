@extends('layout.main')

@section('container')

<span align="center" ><h2>Halaman {{$title}}</h2></span>


<form action="/posts" method="get">
<div class="input-group mb-3">
  <input type="text" class="form-control" placeholder="Search" name="search">
  <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
</div>
</form>

@foreach($posts as $post)
<link href="css/sb-admin-2.min.css" rel="stylesheet">

<div class="card">
  <div class="card-header">
    Author : {{ $post->user->name }}
  </div>
  <div class="card-body">
    <h5 class="card-title"><?= $post->title; ?></h5>
    <p class="card-text"><?= $post->excerpt; ?></p>
    <a href="/posts/{{$post->slug}}" class="btn btn-primary">Read More</a>
  </div>
</div>
<br>
@endforeach

<div class="d-flex justify-content-end">
  {{ $posts->links()}}
</div>
@endsection
