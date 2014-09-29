<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>espresso v1.0</title>

	<!-- CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootswatch/3.2.0/darkly/bootstrap.min.css">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="{{ URL::asset('/assets/css/main.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('/assets/css/animate.css') }}">

	@yield('css')
</head>
<body>

	@include('layouts.partials.navigation')

	<div class="container-fluid">
			@include('layouts.partials.sidebar')

			<div class="content-container">
				<div class="row">
					@yield('content')
				</div>				
			</div>
	</div>

	@include('layouts.partials.footer')

	<!-- Javascript -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

	@yield('javascript')
</body>
</html>