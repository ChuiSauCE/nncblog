@extends('main')


@section('title', "| Edit Tag")


@section('content')

	<form action="{{ route('tags.update', $tag->id)}}" method="POST" role="form">
	<input type="hidden" name="_method" value="put" />
	{{ csrf_field() }}
	<h3 class="text-center">Edit Tag</h3>

	<div class="form-group">
		<input value="{{$tag->name}}" type="text" class="form-control" id="" name="name">
	</div>

	<button type="submit" class="btn btn-primary btn-block">Save Changes</button>
</form>


@endsection