@extends('layouts.app')

@section('content')
    <div class="box">
        <div class="box-header">
            {{ __('Login') }}
        </div>

        <form class="box-inside" method="POST" action="{{ route('login') }}">
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
                <label class="inline-flex items-center text-sm" for="remember">
                    <input
                        type="checkbox"
                        name="remember"
                        id="remember"
                        class="form-checkbox" {{ old('remember') ? 'checked' : '' }}
                    >

                    <span class="ml-2">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex flex-col items-center">
                <button
                    type="submit"
                    class="button w-full"
                >
                    {{ __('Login') }}
                </button>

                @if (Route::has('password.request'))
                    <a
                        class="text-xs mt-2 whitespace-no-wrap ml-auto"
                        href="{{ route('password.request') }}"
                    >
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                @if (Route::has('register'))
                    <p class="w-full text-xs text-center mt-6 -mb-3">
                        {{ __("Don't have an account?") }}

                        <a
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
