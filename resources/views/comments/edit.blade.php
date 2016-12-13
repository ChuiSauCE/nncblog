@extends('main')


@section('title', '| Edit Comment')


@section('content')

	<h2>Edit Comment</h2>
	
	<form action="{{route('comments.update', $comment->id)}}" method="POST" role="form">
	{{csrf_field()}}
	<input type="hidden" name="_method" value="put">

		<div class="form-group">
			<label for="name">Name:</label>
			<input disabled type="text" class="form-control" id="name" name="name" value="{{$comment->name}}">
		</div>
		<div class="form-group">
			<label for="email">Email:</label>
			<input disabled type="email" class="form-control" id="email" name="email" value="{{$comment->email}}">
		</div>
		<div class="form-group">
			<label for="comment">Comment:</label>
			<textarea class="form-control" name="comment" id="comment" rows="10">{{$comment->comment}}</textarea>
		</div>



		<button type="submit" class="btn btn-primary pull-right">Submit</button>
	</form>

@endsection