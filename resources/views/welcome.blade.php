@extends('layouts.app')

@section('content')
    <div class="w-full flex items-center justify-center">
        <div class="flex flex-col items-center justify-center">
            <svg
                class="logo relative w-32 h-32" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="48px"
                height="48px"
            >
                <path
                    fill="#9fa8da"
                    d="M38,5H14c-2.21,0-4.82,1.07-4.98,6H9c0,0,0,19.82,0,28l0.02-0.05C9.2,42.58,11.56,43,12.61,43H37	c2,0,2-2,2-2V6C39,5.45,38.55,5,38,5z"
                />
                <path
                    fill="#ffe0b2"
                    d="M36,36H12.607C11.275,36,11,37.119,11,38.5c0,1.382,0.275,2.502,1.607,2.502L36,41V36z"
                />
                <path fill="#e0b990" d="M12.607,36c-1.167,0-1.522,0.858-1.593,2H36v-2H12.607z" />
                <path fill="#9575cd" d="M38,36h-2v7c0.188,0,0.5,0,1,0c2,0,2-2,2-2v-5.998C39,35.553,38.553,36,38,36z" />
                <path
                    fill="#5c6bc0"
                    d="M31.272,31.024c-3.256,0-7.776-3.025-11.523-6.772l0,0l0,0c-4.968-4.967-8.667-11.295-5.729-14.232	c2.937-2.936,9.265,0.762,14.232,5.729c4.968,4.967,8.667,11.295,5.729,14.232C33.259,30.703,32.333,31.024,31.272,31.024z M16.739,10.996c-0.571,0-1.015,0.147-1.306,0.438c-1.364,1.365,0.438,6.113,5.729,11.404l0,0c5.292,5.291,10.04,7.094,11.404,5.729	c1.364-1.365-0.438-6.113-5.729-11.404C22.674,12.999,18.847,10.996,16.739,10.996z"
                />
                <path
                    fill="#5c6bc0"
                    d="M16.728,31.024c-1.061,0-1.987-0.321-2.709-1.043c-2.937-2.938,0.761-9.265,5.729-14.232	c4.968-4.968,11.296-8.666,14.232-5.729c2.937,2.938-0.761,9.265-5.729,14.232l0,0l0,0C24.504,27.999,19.984,31.024,16.728,31.024z M31.261,10.996c-2.107,0-5.935,2.003-10.098,6.167c-5.292,5.291-7.094,10.04-5.729,11.404c1.369,1.366,6.114-0.438,11.404-5.729	l0,0c5.292-5.291,7.094-10.04,5.729-11.404C32.276,11.143,31.831,10.996,31.261,10.996z"
                />
                <circle cx="24" cy="20" r="2" fill="#ff1744" />
                <circle cx="17" cy="10" r="2" fill="#ffcc80" />
                <circle cx="31" cy="30" r="2" fill="#80deea" />
            </svg>

            <div class="flex items-center justify-center w-1/2 h-4">
                <div class="bg-black shadow opacity-50 border-4" />
            </div>
        </div>

        <div class="flex flex-col items-center">
            <h1 class="mt-6 text-xl text-center font-bold">
                The techie bullet journal
            </h1>

            <a class="button w-full mt-6" href="{{ route('register') }}">
                Sign up now
            </a>

            <div class="mt-6 box w-full">
                <div class="box-header">
                    Why ?
                </div>

                <div class="box-inside">
                    <p>
                        As a <b class="text-indigo-400">human</b>, you are having great times and new achievements
                        everyday.
                    </p>

                    <p class="mt-3">
                        Keep <b class="text-indigo-400">log</b> of them the easiest way using Journapi.
                    </p>

                    <p class="mt-3">
                        When the hard times comes, use it to reflect on your life and <b class="text-indigo-400">stay
                            positive</b>.
                    </p>
                </div>
            </div>

            <div class="w-full mt-3 mb-3 flex items-center justify-between text-xs">
                <a class="block" href="{{ route('privacy') }}">
                    Privacy policies
                </a>
                <a class="block" href="https://yael.dev/posts/journapi">
                    The story behind
                </a>
            </div>

            @include('partials.producthuntbutton')
        </div>
    </div>
@endsection
