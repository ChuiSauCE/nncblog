@extends('main')


@section('title', '| Create a Post')
@section('styles')
	{!! Html::style('css/parsley.css') !!}
@endsection
@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>Create New Post</h1>
			<hr>
			<form enctype="multipart/form-data" data-parsley-validate action="{!! action('PostController@store') !!}" method="POST" role="form">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">

				<div class="form-group">
					<label for="title">Title:</label>
					<input type="text" class="form-control" id="title" name="titleform" placeholder="Title" required >
				</div>
				<div class="form-group">
					<select name="category_idform" id="" class="form-control">
						@foreach($categories as $category)
							<option value="{{ $category->id }}">{{ $category->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<select name="tags[]" id="" class="select2-multi form-control multiselect multiselect-info" multiple="multiple">
						@foreach($tags as $tag)
							<option value="{{ $tag->id }}">{{ $tag->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="featured_image" class="pull-left">Put your image here:</label>
					<input class="form-control" type="file" name="featured_image" id="featured_image">
				</div>
				<div class="form-group">
					<label for="body">Post Content:</label>
					<textarea type="text" class="form-control" rows="10" id="body" name="bodyform" placeholder="Post Content"></textarea>
				</div>
				<button type="submit" class="btn btn-success btn-large btn-block">Submit</button>
			</form>
		</div>
	</div>
@endsection
@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	 <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".select2-multi").select2();
		});
	</script>
  <script>
		tinymce.init({ 
			selector:'textarea' ,
			plugins: 'link code',
			menubar: false
		});
	</script>
@endsection