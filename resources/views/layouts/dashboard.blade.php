<!DOCTYPE html>
<html lang="is">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#4299e1"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Park and Fly | Stjórnborð</title>
    <meta name="Description" content="Tryggðu þér öruggt bílastæði meðan þú ferðast. ">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

    <link rel="shortcut icon" type="image/png" href="/images/favicon.png"/>

    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700&display=swap" rel="stylesheet">

    @yield ('head')
</head>
<body>
    <header class="pt-20 pb-10">
        <div class="container max-w-5xl mx-auto px-6">
            <nav>
                <div class="flex">
                    <div class="flex-1">
                        <h1 class="font-bold text-4xl mb-8 pr-3">
                            <img src="/images/logo.png" width="60%" height="auto">
                        </h1>
                    </div>
                    <div class="flex-1">
                        <ul class="flex float-right">
                            <li class="pr-4">
                                <a href="#">Stillingar</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Útskrá') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <section id="app">
        <div class="container max-w-5xl mx-auto px-6">
            <div class="flex">
                <div class="w-1/4">
                    <h4 class="font-bold mb-2 uppercase text-lg"><a href="{{ route('today') }}" class="hover:text-orange-500 transition">Í dag</a></h4>

                    <ul class="ml-6 mb-8">
                        <li class="mb-1">
                            <a href="{{ route('todayIn') }}" class="hover:text-orange-500 transition">Koma inn</a>
                        </li>
                        <li>
                            <a href="{{ route('todayGoingOut') }}" class="hover:text-orange-500 transition">Fara út</a>
                        </li>
                    </ul>

                    <h4 class="font-bold mb-2 uppercase text-lg">Á morgun</h4>

                    <ul class="ml-6 mb-20">
                        <li class="mb-1">
                            <a href="#" class="hover:text-orange-500 transition">Koma inn</a>
                        </li>
                        <li>
                            <a href="#" class="hover:text-orange-500 transition">Fara út</a>
                        </li>
                    </ul>

                    <ul>
                        <li class="mb-1">
                            <a href="#" class="hover:text-orange-500 transition">Leita</a>
                        </li>
                    </ul>
                </div>
                <div class="w-3/4 flex flex-wrap">
                    @yield ('main')
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
