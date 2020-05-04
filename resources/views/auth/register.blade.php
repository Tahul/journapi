@extends('layouts.app')

@section('content')
    <div class="box">
        <div class="box-header">
            {{ __('Register') }}
        </div>

        <form class="box-inside" method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-field"> <!-- Name -->
                <label for="name">
                    {{ __('Name') }}
                </label>

                <input
                    id="name"
                    type="text"
                    class="form-input @error('name') error @enderror"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    autocomplete="name"
                    autofocus
                >

                @error('name')
                <p>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="form-field"> <!-- Email -->
                <label for="email">
                    {{ __('Email') }}
                </label>

                <input
                    id="email"
                    type="email"
                    class="form-input @error('email') error @enderror"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autocomplete="email"
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
                    required autocomplete="new-password"
                >

                @error('password')
                <p>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="form-field"> <!-- Confirm password -->
                <label for="password-confirm">
                    {{ __('Confirm password') }}
                </label>

                <input
                    id="password-confirm"
                    type="password"
                    class="form-input"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                >
            </div>

            <div class="flex flex-col">
                <button type="submit"
                        class="button w-full">
                    {{ __('Register') }}
                </button>

                <p class="w-full text-xs text-center mt-6 -mb-3">
                    {{ __('Already have an account?') }}
                    <a href="{{ route('login') }}">
                        {{ __('Login') }}
                    </a>
                </p>
            </div>
        </form>
    </div>
@endsection
