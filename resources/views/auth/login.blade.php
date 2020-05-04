@extends('layouts.app')

@section('content')
    <div class="flex flex-col break-words bg-white border-4 border-indigo-400 rounded-lg shadow-md">

        <div class="font-semibold bg-indigo-400 text-white py-3 px-6 mb-0">
            {{ __('Login') }}
        </div>

        <form class="w-full p-6" method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-field"> <!-- Email -->
                <label for="email">
                    {{ __('Email') }}
                </label>

                <input
                    id="email"
                    type="email"
                    class="form-input @error('email') error @enderror"
                    name="email" value="{{ old('email') }}"
                    required
                    autocomplete="email"
                    autofocus
                >

                @error('email')
                <p>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="form-field"> <!-- Password -->
                <label for="password">
                    {{ __('Password') }}
                </label>

                <input
                    id="password"
                    type="password"
                    class="form-input @error('password') error @enderror"
                    name="password"
                    required
                >

                @error('password')
                <p>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="flex mb-6"> <!-- Remember me -->
                <label class="inline-flex items-center text-sm text-gray-700" for="remember">
                    <input
                        type="checkbox"
                        name="remember"
                        id="remember"
                        class="form-checkbox" {{ old('remember') ? 'checked' : '' }}
                    >

                    <span class="ml-2">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex flex-wrap items-center">
                <button
                    type="submit"
                    class="button"
                >
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a
                        class="text-sm text-blue-500 hover:text-blue-700 whitespace-no-wrap no-underline ml-auto"
                        href="{{ route('password.request') }}"
                    >
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                @if (Route::has('register'))
                    <p class="w-full text-xs text-center text-gray-700 mt-8 -mb-4">
                        {{ __("Don't have an account?") }}

                        <a
                            class="text-blue-500 hover:text-blue-700 no-underline"
                            href="{{ route('register') }}"
                        >
                            {{ __('Register') }}
                        </a>
                    </p>
                @endif
            </div>
        </form>
    </div>
@endsection
