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
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="48px" height="48px"
                     class="w-8 h-8 mr-1">
                    <path fill="#9fa8da"
                          d="M38,5H14c-2.21,0-4.82,1.07-4.98,6H9c0,0,0,19.82,0,28l0.02-0.05C9.2,42.58,11.56,43,12.61,43H37	c2,0,2-2,2-2V6C39,5.45,38.55,5,38,5z"/>
                    <path fill="#ffe0b2"
                          d="M36,36H12.607C11.275,36,11,37.119,11,38.5c0,1.382,0.275,2.502,1.607,2.502L36,41V36z"/>
                    <path fill="#e0b990" d="M12.607,36c-1.167,0-1.522,0.858-1.593,2H36v-2H12.607z"/>
                    <path fill="#9575cd"
                          d="M38,36h-2v7c0.188,0,0.5,0,1,0c2,0,2-2,2-2v-5.998C39,35.553,38.553,36,38,36z"/>
                    <path fill="#5c6bc0"
                          d="M31.272,31.024c-3.256,0-7.776-3.025-11.523-6.772l0,0l0,0c-4.968-4.967-8.667-11.295-5.729-14.232	c2.937-2.936,9.265,0.762,14.232,5.729c4.968,4.967,8.667,11.295,5.729,14.232C33.259,30.703,32.333,31.024,31.272,31.024z M16.739,10.996c-0.571,0-1.015,0.147-1.306,0.438c-1.364,1.365,0.438,6.113,5.729,11.404l0,0c5.292,5.291,10.04,7.094,11.404,5.729	c1.364-1.365-0.438-6.113-5.729-11.404C22.674,12.999,18.847,10.996,16.739,10.996z"/>
                    <path fill="#5c6bc0"
                          d="M16.728,31.024c-1.061,0-1.987-0.321-2.709-1.043c-2.937-2.938,0.761-9.265,5.729-14.232	c4.968-4.968,11.296-8.666,14.232-5.729c2.937,2.938-0.761,9.265-5.729,14.232l0,0l0,0C24.504,27.999,19.984,31.024,16.728,31.024z M31.261,10.996c-2.107,0-5.935,2.003-10.098,6.167c-5.292,5.291-7.094,10.04-5.729,11.404c1.369,1.366,6.114-0.438,11.404-5.729	l0,0c5.292-5.291,7.094-10.04,5.729-11.404C32.276,11.143,31.831,10.996,31.261,10.996z"/>
                    <circle cx="24" cy="20" r="2" fill="#ff1744"/>
                    <circle cx="17" cy="10" r="2" fill="#ffcc80"/>
                    <circle cx="31" cy="30" r="2" fill="#80deea"/>
                </svg>

                {{ config('app.name', 'Journapi') }}
            </a>

            <div>
                @guest
                    <a class="text-sm" href="{{ route('login') }}">{{ __('Login') }}</a>

                    @if (Route::has('register'))
                        <a class="text-sm" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <a class="select-none text-sm pr-3" href="/journal">Journal</a>
                    <a class="select-none text-sm" href="/settings">Settings</a>
                @endguest
            </div>
        </div>
    </nav>

    @yield('content')

    <livewire:scripts/>
</div>
</body>
</html>
