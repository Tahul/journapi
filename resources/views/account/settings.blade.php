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
                Settings
            </div>

            <div class="box-inside">
                {{ $token }}
            </div>
        </div>
    </div>
@endsection
