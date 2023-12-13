@extends('layout.main')
@section('container')
<span align="center" ><h2>Edit Comment</h2></span>
<div class="col-lg-8">
<form method="post" action="/dashboard/comment/{{$comment->slug}}">
 @method('put')
@csrf 

<div class="mb-3">
 <label for="slug" class="form-label">Slug</label>
 <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" 
name="slug" required value="{{ old('slug', $comment->slug)}}">
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
 @if(old('category_id',$comment->category_id)==$category->id)
 <option value="{{$category->id}}" selected>{{$category->name}}</option>
 @else
 <option value="{{$category->id}}">{{$category->name}}</option>
 @endif
 @endforeach
 </select>
</div> 
<div class="mb-3">
 <label for="body" class="form-label">Body</label>
 <textarea name="body" id="body" class="form-control" cols="10" rows="5">{{ old('body', 
$comment->body)}}</textarea>
 @error('body')
 <p class="text-danger">{{$message}}</p>
 @enderror
</div>
<button type="submit" class="btn btn-primary">Update Comment</button>
</form>
</div>
<script>
const username = document.querySelector('#username');
const slug = document.querySelector('#slug');
username.addEventListener('change',function(){
 fetch('/dashboard/comment/checkSlug?username=' + username.value)
 .then(response=>response.json())
 .then(data=>slug.value=data.slug)
});
</script>
 
@endsection