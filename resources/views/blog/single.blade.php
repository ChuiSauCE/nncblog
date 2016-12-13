@extends('main')


@section('title', "| $post->title")

@section('content')

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<img class="img-responsive" src="{{asset('images/' . $post->image)}}" alt="{{$post->title}}">
			<h1>{{ $post->title }}</h1>
			<p>{!! $post->body !!}</p>
			<hr>
		</div>
		<div class="col-md-8 col-md-offset-2">
			<h2 class="comments-title"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span>{{ $post->comments()->count() }} Comments:</h2>
			@foreach($post->comments as $comment)
				<div class="comment-box">
					<div class="author-info">
						<img src="{{ 'https://www.gravatar.com/avatar/'.md5(strtolower(trim($comment->email))).'?d=wavatar' }}" class="author-image">
						<div class="author-name">
							<h5>{{ $comment->name }}</h5>
							<p>{{ date('nS F, Y - g:iA', strtotime($comment->created_at))}}</p>
						</div>
					</div>
					<div class="comment-content">{{ $comment->comment }}</div>
				</div>
			@endforeach
		</div>
	</div>
	<div class="row">
		<form class="col-md-8 col-md-offset-2" action="{{ route('comments.store')}}" method="POST" role="form">
			
		{{ csrf_field() }}
		<input type="text" name="post_id" class="hide" value="{{$post->id}}">
		<div class="form-group col-md-6">
			<label for="name">Name:</label>
			<input type="text" class="form-control" id="name" name="name" placeholder="Your Name">
		</div>
		<div class="form-group col-md-6">
			<label for="email">Email:</label>
			<input type="text" class="form-control" id="email" name="email" placeholder="Your Email">
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="comment">Your Comment:</label>
				<textarea name="comment" id="comment" class="form-control" rows="10" required="required"></textarea>
			</div>
		</div>
		
		<div class="col-md-12">
			<button type="submit" class="btn btn-primary pull-right">Submit</button>
		</div>		
		</form>
	</div>
@endsection