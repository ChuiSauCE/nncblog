<!DOCTYPE html>
<html lang="en">
	<head>
		@include('partials._head')
	</head>
	<body>
		@include('partials._nav')
		<div class="container">
			@include('partials._messages')
			@yield('content')
		</div> <!-- End of container -->
		<footer>
			@include('partials._footer')
		</footer>
		@include('partials._javascripts')
		@yield('scripts')
	</body>
</html>
