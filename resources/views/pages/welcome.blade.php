@extends('main')
@section('title', '| Homepage')
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="jumbotron">
				<h1>Welcome to My Blog!</h1>
				<p class="lead">Thank you for visiting. This is my tesst website build with Laravel. Please read my most popular post</p>
				<p><a href="" class="btn btn-primary btn-lg">Popular Post</a></p>
			</div>
		</div>
	</div><!-- end of header .row -->
	<div class="row">
		<div class="col-md-8">
		@foreach($posts as $post)
			<div class="post">
				<h3>{{ $post->title }}</h3>
				<p>{{ substr(strip_tags($post->body), 0, 300) }}{{ strlen(strip_tags($post->body)) > 300 ? "..." : "" }}</p>
				<a href="{{ route('blog.single', $post->slug) }}" class="btn btn-warning">Read More!</a>
			</div>
			<p>Posted At: <b>{{ $post->category->name }}</b></p>
			<hr>
		@endforeach
		</div>

		<div class="col-md-3 col-md-offset-1">
			<h2>Sidebar</h2>
		</div>
	</div>
@endsection