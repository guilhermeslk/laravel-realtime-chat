<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Realtime Chat w/ Laravel</title>
		
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
		<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
		<link rel="stylesheet" href="{{ asset('css/chat.css')}}">
	</head>
	<body>
		@yield('body')
	</body>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="https://cdn.socket.io/socket.io-1.2.0.js"></script>
		
	@yield('scripts')
</html>
