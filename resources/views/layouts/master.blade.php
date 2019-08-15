<!DOCTYPE html>
<html lang="is">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	{{-- <meta name="theme-color" content="#4dc0b5"/> --}}
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Park and Fly</title>
	{{-- <meta name="Description" content="Web Developer with a passion for designing beautiful and functional user experiences."> --}}

	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
	@yield ('head')
</head>
<body>
	@yield ('header')

	<div id="app">  
		@yield ('main')
	</div>

	@yield ('footer')

	<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
