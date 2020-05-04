@extends('layouts.app')

@section('content')
    <div class="box">
        <div class="box-header">
            {{ __('Reset password') }}
        </div>

        <form class="box-inside" method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-field"> <!-- Email -->
                <label for="email">
                    {{ __('Email') }}
                </label>

                <input
                    id="email"
                    type="email"
                    class="form-input w-full @error('email') error @enderror"
                    name="email"
                    value="{{ $email ?? old('email') }}"
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
                    class="form-input w-full @error('password') error @enderror"
                    name="password"
                    required
                    autocomplete="new-password"
                >

                @error('password')
                <p>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="form-field"> <!-- Password confirm -->
                <label for="password-confirm">
                    {{ __('Confirm password') }}
                </label>

                <input
                    id="password-confirm"
                    type="password"
                    class="form-input w-full"
                    name="password_confirmation"
                    required
                    autocomplete="new-password"
                >
            </div>

            <div class="flex flex-wrap">
                <button
                    type="submit"
                    class="button w-full"
                >
                    {{ __('Reset password') }}
                </button>
            </div>
        </form>

    </div>
@endsection
