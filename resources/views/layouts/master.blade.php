<!DOCTYPE html>
<html lang="is">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	{{-- <meta name="theme-color" content="#4dc0b5"/> --}}
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>Park and Fly | Tryggðu þér öruggt bílastæði meðan þú ferðast</title>
	<meta name="Description" content="Tryggðu þér öruggt bílastæði meðan þú ferðast. ">

	<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-145924221-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-145924221-1');
    </script>

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
