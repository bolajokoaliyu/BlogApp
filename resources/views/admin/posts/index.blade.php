@extends('layouts.admin')

@section('content')


@if(Session::has('deleted_post'))
  <h3 class="bg-danger">{{session('deleted_post')}}</h3>

@endif

<h1>Posts</h1>

<table class="table">
    <thead>
      <tr>
        <th>Id</th>
        <th>Photo</th>
        <th>Owner</th>
        <th>Category</th>               
        <th>Title</th>
        <th>Body</th>      
        <th>Posts</th>
        <th>Comments</th>
        <th>Created At</th>
        <th>Updated At</th>
      </tr>
    </thead>
    <tbody>
    	@foreach($posts as $post)
	      <tr>
	        <td>{{$post->id}}</td>
          <td><img height="50" src="{{$post->photo ? $post->photo->file : '/images/400x400.png'}}"></td>
	        <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->user->name}}</a></td>
           <td>{{$post->category ? $post->category->name : 'UNCATEGORIZED'}}</td>
          <td>{{$post->title}}</td>
	        <td>{{str_limit($post->body, 15)}}</td>
          <td><a href="{{route('home.post', $post->id)}}">View Post</a></td>
          <td><a href="{{route('admin.comments.show', $post->id)}}">View Comments</a></td>
	        <td>{{$post->created_at->diffForHumans()}}</td>
	        <td>{{$post->updated_at->diffForHumans()}}</td>
	      </tr>
     	 @endforeach     
    </tbody>
  </table>
  <div class="row">
    <div class="col-sm-6 col-sm-offset-5">
      {{$posts->render()}}
    </div>
  </div>


@stop