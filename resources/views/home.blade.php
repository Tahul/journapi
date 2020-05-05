@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div
            class="alert success"
            role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div
            class="alert error"
            role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="box">
        <div class="box-header">
            Write in my journal
        </div>

        <div class="box-inside">
            <form action="{{ route('bullet.store') }}" method="POST">
                @csrf

                <div class="form-field">
                    <textarea
                        class="form-textarea w-full @error('bullet') error @enderror"
                        name="bullet"
                        id="bullet-input"
                        rows="3"
                    ></textarea>

                    @error('bullet')
                    <p>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <button class="button w-full">Add to my journal</button>
            </form>
        </div>
    </div>


    @foreach($bullets as $date => $values)
        <h3 class="py-2 my-6 w-full bg-gray-400">> {{ $date }}</h3>

        @foreach($values as $bullet)
            <div class="mt-3">
                <span>> {{ $bullet->created_at->format('h:i:s') }}:</span>
                {{ $bullet->bullet }}
            </div>
        @endforeach
    @endforeach
@endsection
