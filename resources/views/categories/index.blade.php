@extends('main')


@section('title', '| All Categories')


@section('content')

	<div class="row">
		<div class="col-sm-8">
			<h1>Categories</h1>
			<table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
           @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
            </tr>
           @endforeach
        </tbody>
    </table>

		</div>
		
		<div class="col-sm-3">
		 <div class="well">
				<form action="{{ route('categories.store') }}" method="POST" role="form">
					{{ csrf_field() }}
					<legend>New Category</legend>

					<div class="form-group">
						<label for="category-name">Category Name</label>
						<input type="text" class="form-control" name="name" id="category-name" placeholder="">
					</div>
					
					<button type="submit" class="btn btn-primary btn-block">Create</button>
				</form>
			</div>
		</div>
	</div>

@endsection