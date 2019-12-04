@extends('layouts.blog-post')


@section('content')


	<h1>Post</h1>

	<!-- Blog Post -->

                <!-- Title -->
                <h1>{{$post->title}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="#">{{$post->user->name}}</a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="{{$post->photo ? $post->photo->file : '/images/400x400.png'}}" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead">{!! $post->body !!}</p>                

                <hr>

                <!-- Blog Comments -->
                @if(Session::has('comment_message'))
				  <h3 class="bg-danger">{{session('comment_message')}}</h3>

				@endif

				@if(Auth::check())
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                   	{!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}
                        <input type="hidden" name="post_id" value="{{$post->id}}">

                        <div class="form-group">
					    	{!! Form::label('body', 'Body:') !!}
					    	{!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
				    	</div>

					    <div class="form-group">
					    	{!! Form::submit('Submit Comment', ['class'=>'btn btn-primary']) !!}
					    </div>
                     {!! Form::close() !!}
                </div>
                @endif

                <hr>

                <!-- Posted Comments -->
                @if(count($comments) > 0)

                <!-- Comment -->
                	@foreach($comments as $comment)
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" height="50" src="{{$comment->photo}}" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">{{$comment->authpr}}
                            <small>{{$comment->created_at->diffForHumans()}}</small>
                        </h4>
                        <p>{{$comment->body}}</p>

                        <!-- Nested Comment -->
                                         		
	                        <div id="nested-comment" class="media">
                                @if(count($comment->replies) > 0)
	                        	<div class="media">
	                        		@foreach($comment->replies as $reply)
	                        		@if($reply->is_active == 1)
		                            <a class="pull-left" href="#">
		                                <img class="media-object" height="50" src="{{$reply->photo}}" alt="">
		                            </a>
		                            <div class="media-body">
		                                <h4 class="media-heading">{{$reply->author}}
		                                    <small>{{$reply->created_at->diffForHumans()}}</small>
		                                </h4>
		                                <p>{{$reply->body}}</p>
		                            </div>
		                            @endif
		                            @endforeach
	                            </div>
                                @endif

	                            <div class="comment-reply-container">
	                            	
	                            	<button class="toggle-reply btn btn-primary pull-right">Reply</button>
	                            	<div class="comment-reply col-sm-8">

	                            	{!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@createReply']) !!}
	                                	<div class="form-group">
	                                		<input type="hidden" name="comment_id" value="{{$comment->id}}">
									    	{!! Form::label('body', 'Reply:') !!}
									    	{!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>1]) !!}
									    </div>

	                                	<div class="form-group">
	                						{!! Form::submit('Submit', ['class'=>'btn btn-primary col-sm-3']) !!}
	            						</div>
	                            	{!! Form::close() !!}
	                            	</div>
	                            </div>
	                        </div>
	                        <!-- End Nested Comment -->
                       		
                    
                    </div>

                    
                </div>
                @endforeach
                @endif             

@stop

@section('categories')

	<h4>Blog Categories</h4>

                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                @foreach($categories as $category)
                                <li><a href="#">{{$category->name}}</a>
                                </li> 
                                @endforeach                               
                            </ul>
                        </div>
                        
                    </div>
                    <!-- /.row -->

@stop

@section('scripts')
<script type="text/javascript">
	$(".comment-reply-container .toggle-reply").click(function(){
	$(this).next().slideToggle("slow");
	});
</script>
	

@stop