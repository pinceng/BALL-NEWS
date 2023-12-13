@extends('layout.main')
@section('container')
<span align="center" ><h2>Create New News</h2></span>
<div class="col-lg-8">
    <form method="post" action="/dashboard/post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
         <label for="title" class="form-label">Title</label>
         <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
         name="title" required autofocus value="{{ old('title')}}">
         @error('title')
         <div class="invalid-feedback">
             {{$message}}
         </div>
         @enderror
     </div>
     <div class="mb-3">
         <label for="slug" class="form-label">Slug</label>
         <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
         name="slug" required value="{{ old('slug')}}">
         @error('slug')
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
        <label for="formFile" class="form-label">Image</label>
        <input class="form-control" name="image" type="file" id="formFile">
        @error('image')
         <div class="invalid-feedback">
             {{$message}}
         </div>
         @enderror
    </div>
    <div class="mb-3">
        <div class="card">
            <img src="" class="card-img-top" id="image" alt="...">
    </div>
    <div class="mb-3">
        <label for="formFile" class="form-label">Video</label>
        <input class="form-control" name="video" type="file" id="formFile1">
        @error('image')
         <div class="invalid-feedback">
             {{$message}}
         </div>
         @enderror
    </div>
    <div class="mb-3">
        <div class="card">
            <video src="" class="card-img-top" id="video" alt="..." autoplay>
    </div>
</div>


<div class="mb-3">
 <label for="body" class="form-label">Body</label>
 <textarea name="body" id="body" class="form-control" cols="10" rows="5" value="{{
    old('body')}}"></textarea>
    @error('body')
    <p class="text-danger">{{$message}}</p>
    @enderror
</div>
<button type="submit" class="btn btn-primary">Create Post</button>
</form>
</div>
<script>
    const title = document.querySelector('#title');
    const slug = document.querySelector('#slug');
    title.addEventListener('change',function(){
     fetch('/dashboard/post/checkSlug?title=' + title.value)
     .then(response=>response.json())
     .then(data=>slug.value=data.slug)
 });

    document.getElementById("formFile").addEventListener("change", function (e) {
        const reader = new FileReader();
        reader.onloadend = function () {
            console.log(reader.result);
            document.getElementById("image").setAttribute("src", reader.result);
        }

        reader.readAsDataURL(e.target.files[0]);
    })

    document.getElementById("formFile1").addEventListener("change", function (e) {
        const reader = new FileReader();
        reader.onloadend = function () {
            console.log(reader.result);
            document.getElementById("video").setAttribute("src", reader.result);
        }

        reader.readAsDataURL(e.target.files[0]);
    })
</script>
@endsection 