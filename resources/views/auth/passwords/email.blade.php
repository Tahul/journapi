@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div
            class="alert"
            role="alert"
        >
            {{ session('status') }}
        </div>
    @endif

    <div class="box">
        <div class="box-header">
            {{ __('Reset password') }}
        </div>

        <form class="box-inside" method="POST" action="{{ route('password.email') }}">
            @csrf

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
                    autofocus
                >

                @error('email')
                <p>
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="flex flex-col">
                <button
                    type="submit"
                    class="button w-full"
                >
                    {{ __('Send password reset link') }}
                </button>

                <p class="w-full text-xs text-center mt-6 -mb-3">
                    <a href="{{ route('login') }}">
                        {{ __('Back to login') }}
                    </a>
                </p>
            </div>
        </form>
    </div>
@endsection
