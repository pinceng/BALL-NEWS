@extends('layout.main')
@section('container')
<h2>My News</h2>
@if(session()->has('success'))
<div class="alert alert-success" role="alert">
   {{session('success')}}
</div>
@endif
<div class="table-responsive col-lg-8">
   <a href="/dashboard/post/create" class="btn btn-primary mb-3">Create new news</a>
   <table class="table table-striped table-hover">
       <thead>
           <tr>
               <th scope="col">#</th>
               <th scope="col">Title</th>
               <th scope="col">Category</th>
               <th scope="col">Action</th>
           </tr>
       </thead>
       <tbody>
           @foreach ($posts as $post)
           <tr>
               <th scope="row">{{ $loop->iteration }}</th>
               <td>{{$post->title}}</td>
               <td>{{$post->category->name}}</td>
               <td>
                   <a href="/dashboard/post/{{$post->slug}}" class="badge bg-info"><span data-feather="eye"></span></a>
                   <a href="/dashboard/post/{{$post->slug}}/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                   <form action="/dashboard/post/{{$post->slug}}" method="post" class="d-inline">
                       @method('delete')
                       @csrf
                       <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><span
                        data-feather="x-circle"></span></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection