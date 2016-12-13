@extends('main')


@section('title', '| View Post')


@section('content')
	<div class="row">
		<div class="col-md-8">
			<h1>{{ $post->title }}</h1>
			<p class="lead">{!! $post->body !!}</p>
			<hr>
			<div class="tags">
			@foreach($post->tags as $tag)
			
			<span class="label label-default">{{$tag->name}}</span>
			
			@endforeach
			</div>
			<div class="backend-comments" style="margin-top: 50px">
				<h3>Comments <small>{{ $post->comments()->count() }} Total.</small></h3>
					<table class="table table-hover">
						<thead>
								<tr>
										<th>Name</th>
										<th>Email</th>
										<th>Comment</th>
										<th></th>
								</tr>
						</thead>
						<tbody>
							@foreach($post->comments as $comment)
								<tr>
										<td>{{ $comment->name }}</td>
										<td>{{ $comment->email }}</td>
										<td>{{ $comment->comment }}</td>
										<td>
											<a href="{{route('comments.edit', $comment->id)}}" class="btn btn-xs btn-default">
												<span class="glyphicon glyphicon-pencil"></span>
											</a>
											<a href="#" class="btn btn-xs btn-danger" onclick="event.preventDefault();
																			 document.getElementById('destroy{{$comment->id}}').submit();">
												<span class="glyphicon glyphicon-trash"></span>
												<form id="destroy{{$comment->id}}" action="{{ route('comments.destroy', $comment->id) }}" method="POST" style="display: none;">
															{{ csrf_field() }}
															<input type="hidden" name="_method" value="delete">
													</form>
											</a>
										</td>
								</tr>
							@endforeach
						</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-4">
			<div class="well">
				<dl class="dl-horizontal">
					<dt>Slug:</dt>
					<dd>{{ $post->slug }}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>Category:</dt>
					<dd>{{ $post->category->name }}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>Created At:</dt>
					<dd>{{date('j-M-Y H:i', strtotime($post->created_at))}}</dd>
				</dl>
				<dl class="dl-horizontal">
					<dt>Last Updated:</dt>
					<dd>{{date('j-M-Y H:i', strtotime($post->updated_at))}}</dd>
					<hr>
				</dl>
					<div class="row">
						<div class="col-sm-6"><a href="{{ Route('posts.edit', $post->id) }}" class="btn btn-primary btn-block">Edit</a></div>
						<div class="col-sm-6">
							<form action="{{ Route('posts.destroy', $post->id)}}" method="post">
								<input type="hidden" name="_method" value="delete" />
								<input type="hidden" name="_token" value="{!! csrf_token() !!}">
								<button type="submit" class="btn btn-danger btn-block">Delete</button>	
							</form>
						</div>
						<div class="col-sm-12"><a href="{{ route('posts.index') }}" class="btn btn-default btn-block">&#9679; See All</a></div>
					</div>
			</div>
		</div>
	</div>
@endsection