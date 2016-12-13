@extends('main')


@section('title', '| All Tags')


@section('content')

	<div class="row">
		<div class="col-sm-8">
			<h1>Tags</h1>
			<table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($tags as $tag)
            <tr>
                <td>{{ $tag->id }}</td>
                <td><a href="{{ route('tags.show', $tag->id)}}">{{ $tag->name }}</a></td>
            </tr>
           @endforeach
        </tbody>
    </table>

		</div>
		
		<div class="col-sm-3">
		 <div class="well">
				<form action="{{ route('tags.store') }}" method="POST" role="form">
					{{ csrf_field() }}
					<legend>New Tag</legend>

					<div class="form-group">
						<label for="tag-name">Tag Name</label>
						<input type="text" class="form-control" name="name" id="tag-name" placeholder="">
					</div>
					
					<button type="submit" class="btn btn-primary btn-block">Create</button>
				</form>
			</div>
		</div>
	</div>

@endsection