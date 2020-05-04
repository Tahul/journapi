@extends('layouts.app')

@section('content')
    <div>
        @if (session('status'))
            <div
                class="alert"
                role="alert">
                {{ session('status') }}
            </div>
        @endif

        <div class="box">
            <div class="box-header">
                My journal
            </div>

            <div class="box-inside">
                <p>
                    Hello {{ Auth()->user()->name }}! 👋
                </p>

                <p class="mt-6">How was your day today?</p>
            </div>
        </div>
    </div>
@endsection
