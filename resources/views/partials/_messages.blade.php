@if(Session::has('success'))

	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
	</button>
	<strong>Success:</strong>{{ Session::get('success') }}
	</div>


@endif


@if(count($errors) > 0)

	<div class="alert alert-danger">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;
	</button>
		<strong>Errors:</strong>
		<ul>
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>


@endif