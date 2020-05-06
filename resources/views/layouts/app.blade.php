<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" data-turbolinks-track="true" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">

    <livewire:styles/>
</head>

<body class="bg-gray-100 w-full h-screen antialiased leading-none">
<div id="app" class="w-full">
    <nav class="mb-4 py-4">
        <div class="flex items-center justify-between">
            <a href="{{ url('/') }}" class="inline-block flex items-center text-lg font-bold text-gray-700">
                <img src="/images/logo.svg" class="w-8 h-8 mr-1"/>

                {{ config('app.name', 'Journapi') }}
            </a>

            <div>
                @guest
                    <a class="text-sm" href="{{ route('login') }}">{{ __('Login') }}</a>

                    @if (Route::has('register'))
                        <a class="text-sm" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <a class="text-sm pr-3" href="{{ route('home') }}">Journal</a>
                    <a class="text-sm" href="{{ route('settings') }}">Settings</a>
                @endguest
            </div>
        </div>
    </nav>

    @yield('content')

    <livewire:scripts/>
</div>
</body>
</html>
