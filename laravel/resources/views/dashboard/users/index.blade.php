@extends('layout.main')
@section('container')
<h2>My Users</h2>
@if(session()->has('success'))
<div class="alert alert-success" role="alert">
   {{session('success')}}
</div>
@endif
<div class="table-responsive col-lg-8">
   <a href="/dashboard/my-users/create" class="btn btn-primary mb-3">Create new user</a>
   <table class="table table-striped table-hover">
       <thead>
           <tr>
               <th scope="col">#</th>
               <th scope="col">Name</th>
               <th scope="col">Date</th>
               <th scope="col">Action </th>

           </tr>
       </thead>
       <tbody>
           @foreach ($users as $user)
           <tr>
               <th scope="row">{{ $loop->iteration }}</th>
               <td>{{$user->name}}</td>
               <td>{{$user->created_at}}</td>
               <td>
                   <a href="/dashboard/my-users/{{$user->id}}" class="badge bg-info"><span data-feather="eye"></span></a>
                   <form action="/dashboard/my-users/{{$user->id}}" method="post" class="d-inline">
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