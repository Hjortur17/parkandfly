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

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window,document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '372330400325187');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1"
            src="https://www.facebook.com/tr?id=372330400325187&ev=PageView
    &noscript=1"/>
    </noscript>

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
