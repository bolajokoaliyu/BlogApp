@extends('layouts.admin')

@section('content')

@if(Session::has('deleted_user'))
  <h3 class="bg-danger">{{session('deleted_user')}}</h3>

@endif

<h1>Users</h1>

<table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Photo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Status</th>
        <th>Created At</th>
        <th>Updated At</th>
      </tr>
    </thead>
    <tbody>
    	@foreach($users as $user)
	      <tr>
	        <td>{{$user->id}}</td>
         <td><img height="50" src="{{$user->photo ? $user->photo->file : '/images/400x400.png'}}"></td>
	        <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->name}}</a></td>
	        <td>{{$user->email}}</td>
	        <td>{{$user->role ? $user->role->name : 'user has no role'}}</td>
	        <td>{{$user->is_active == 1 ? 'Active' : 'No Active'}}</td>
	        <td>{{$user->created_at->diffForHumans()}}</td>
	        <td>{{$user->updated_at->diffForHumans()}}</td>
	      </tr>
     	 @endforeach

     
    </tbody>
  </table>
  <div class="row">
    <div class="col-sm-6 col-sm-offset-5">
      {{$users->render()}}
    </div>
  </div>
@endsection
