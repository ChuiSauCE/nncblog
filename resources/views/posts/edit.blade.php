@extends('main')


@section('title', '| Edit Blog Post')

@section('styles')
@endsection

@section('content')

<form enctype="multipart/form-data" action="{{ Route('posts.update', $post->id)}}" method="POST" role="form">
<input type="hidden" name="_method" value="put" />
<input type="hidden" name="_token" value="{!! csrf_token() !!}">
	<div class="row">
		<div class="col-md-8">
				<div class="form-group">
					<label for="title">Title:</label>
					<input style="font-weight: bold;font-size: 24px; padding: 10px; height: auto;"name="titleform" type="text" class="form-control" id="title" Value="{{ $post->title }}" >
				</div>
				<div class="form-group">
					<select name="category_idform" id="" class="form-control">
						@foreach($categories as $category)
							<option value="{{ $category->id }}" {{ $category->id == $post->category->id ? "selected": "" }}>{{ $category->name }}</option>
						@endforeach
					</select>
				</div>
				<div class="form-group">
					<label for="body">Body:</label>
					<textarea name="bodyform" type="text" class="form-control" id="body">{!! $post->body !!}</textarea>
				</div>
				<div class="form-group">
					<label for="featured_image">Your Image:</label>
					<input type="file" class="form-control" name="featured_image">
				</div>
				<div class="form-group">
					<select name="tags[]" id="" class="select2-multi form-control multiselect multiselect-info" multiple="multiple">
						@foreach($tags as $tag)
							{{--{{$a = 0}}
							@foreach($post->tags as $tagin)
							 @if($tagin->id == $tag->id)
							 	{{$a = 1}}
							 @endif
							@endforeach--}}
							<option value="{{ $tag->id }}"{{--{{ $a == 1 ? "selected" : "" }}--}}>{{ $tag->name }}</option>
						@endforeach
					</select>
				</div>
		</div>
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Createe At:</dt>
					<dd>{{date('j-M-Y H:i', strtotime($post->created_at))}}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>Last Updated:</dt>
					<dd>{{date('j-M-Y H:i', strtotime($post->updated_at))}}</dd>
					<hr>
				</dl>
					<div class="row">
						<div class="col-sm-6"><a href="{{ Route('posts.show', $post->id) }}" class="btn btn-danger btn-block">Cancel</a></div>
						<div class="col-sm-6"><button type="submit" class="btn btn-success btn-block">Save</a></div>
					</div>
			</div>
		</div>
	</div>
</form>
@endsection


@section('scripts')
	{!! Html::script('js/parsley.min.js') !!}
	 <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$(".select2-multi").select2();
			$(".select2-multi").select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');
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