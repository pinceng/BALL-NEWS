@extends('layout.main')
@section('container')
<span align="center" ><h2>Create New Users</h2></span>
<div class="col-lg-8">
    <form method="post" action="/dashboard/comment">
        @csrf
        <div class="mb-3">
           <label for="name" class="form-label">Name</label>
           <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required value="{{ old('name')}}">
           @error('name')
           <div class="invalid-feedback">
               {{$message}}
           </div>
           @enderror
       </div>
       <div class="mb-3">
           <label for="email" class="form-label">Email</label>
           <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required value="{{ old('email')}}">
           @error('email')
           <div class="invalid-feedback">
               {{$message}}
           </div>
           @enderror
       </div>
       <div class="mb-3">
           <label for="category" class="form-label">Category</label>
           <select name="category_id" id="category_id" class="form-select">
               @foreach($categories as $category)
               <option value="{{$category->id}}">{{$category->name}}</option>
               @endforeach
           </select>
       </div>
       <div class="mb-3">
           <label for="password" class="form-label">Password</label>
           <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required value="{{ old('password')}}">
           @error('password')
           <div class="invalid-feedback">
               {{$message}}
           </div>
           @enderror
       </div>
       
        <button type="submit" class="btn btn-primary">Create Users</button>
    </form>
</div>
<script>
    const username = document.querySelector('#username');
    const slug = document.querySelector('#slug');
    username.addEventListener('change',function(){
       fetch('/dashboard/comments/checkSlug?username=' + username.value)
       .then(response=>response.json())
       .then(data=>slug.value=data.slug)
   });
</script>
@endsection 