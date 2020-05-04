@extends('layouts.app')

@section('content')
    <div class="box">
        <div class="box-header">
            {{ __('Confirm Password') }}
        </div>

        <form class="box-inside" method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <p class="leading-normal">
                {{ __('Please confirm your password before continuing.') }}
            </p>

            <div class="flex flex-wrap my-6">
                <label for="password" class="block text-sm font-bold mb-2">
                    {{ __('Password') }}:
                </label>

                <input id="password" type="password"
                       class="form-input w-full @error('password') error @enderror" name="password" required
                       autocomplete="new-password">

                @error('password')
                <p class="text-red-500 text-xs italic mt-4">
                    {{ $message }}
                </p>
                @enderror
            </div>

            <div class="flex flex-wrap items-center">
                <button type="submit" class="button">
                    {{ __('Confirm Password') }}
                </button>

                @if (Route::has('password.request'))
                    <a class="text-sm text-blue-500 hover:text-blue-700 whitespace-no-wrap no-underline ml-auto"
                       href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
        </form>

    </div>
@endsection
