@extends('layout.main')
@section('container')
<span align="center" ><h2>Edit Post</h2></span>
<div class="col-lg-8">
    <form method="post" action="/dashboard/post/{{$post->slug}}" enctype="multipart/form-data">
       @method('put')
       @csrf 
       <div class="mb-3">
           <label for="title" class="form-label">Title</label>
           <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" 
           name="title" required autofocus value="{{ old('title', $post->title)}}">
           @error('title')
           <div class="invalid-feedback">
               {{$message}}
           </div>
           @enderror
       </div> 
       <div class="mb-3">
           <label for="slug" class="form-label">Slug</label>
           <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" 
           name="slug" required value="{{ old('slug', $post->slug)}}">
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
               @if(old('category_id',$post->category_id)==$category->id)
               <option value="{{$category->id}}" selected>{{$category->name}}</option>
               @else
               <option value="{{$category->id}}">{{$category->name}}</option>
               @endif
               @endforeach
           </select>
       </div> 
       <div class="mb-3">
        <label for="formFile" class="form-label">Image</label>
        <input class="form-control" type="file" id="formFile" name="image">
        @error('image')
         <div class="invalid-feedback">
             {{$message}}
         </div>
         @enderror
    </div>
    <div class="mb-3">
        <div class="card">
            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" id="image" alt="...">
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">Video</label>
            <input class="form-control" name="video" type="file" id="formFile1">
            @error('video')
             <div class="invalid-feedback">
                 {{$message}}
             </div>
             @enderror
        </div>
        <div class="mb-3">
            <div class="card">
                <video src="{{ asset('storage/' . $post->video) }}" class="card-img-top" id="video" alt="..." autoplay>
        </div>
        <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea name="body" id="body" class="form-control" cols="10" rows="5">{{ old('body', 
             $post->body)}}</textarea>
             @error('body')
             <p class="text-danger">{{$message}}</p>
             @enderror
         </div>
        <button type="submit" class="btn btn-primary">Update Post</button>
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
