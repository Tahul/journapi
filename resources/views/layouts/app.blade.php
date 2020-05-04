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
</head>

<body class="bg-gray-100 w-full h-screen antialiased leading-none">
<div id="app" class="w-full">
    <nav class="mb-4 py-4">
        <div class="flex items-center justify-between">
            <a href="{{ url('/') }}" class="text-lg font-bold text-gray-700">
                {{ config('app.name', 'Laravel') }}
            </a>

            <div>
                @guest
                    <a class="text-sm" href="{{ route('login') }}">{{ __('Login') }}</a>

                    @if (Route::has('register'))
                        <a class="text-sm" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <a class="text-sm pr-3" href="{{ route('home') }}">My journal</a>
                    <a class="text-sm" href="{{ route('settings') }}">Settings</a>
                @endguest
            </div>
        </div>
    </nav>

    @yield('content')
</div>
</body>
</html>
