@extends('layouts.app')

@section('content')
    @include('partials.alert')

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
        <div x-data="{ visible: false }">
            <h3
                class="p-2 my-6 w-full bg-indigo-400 rounded-lg text-lg bold text-white cursor-pointer flex justify-between items-center"
                @click="visible = !visible"
            >
                {{ $date }}

                <img
                    class="w-4 h-4 block transform transition-transform duration-100 ease-in"
                    :class="{ 'rotate-180': visible }" src="/images/chevron.svg"
                />
            </h3>

            @foreach($values as $bullet)
                <div class="mt-6" x-show="visible === true">
                    <p class="mb-3">
                        {{ $bullet->bullet }}
                    </p>

                    <span
                        class="select-none block w-full mb-3 text-sm text-right"
                    >
                        {{ $bullet->created_at->format('h:i:s') }}
                    </span>

                    <span class="block w-full h-1 bg-gray-400 rounded-full"></span>
                </div>
            @endforeach
        </div>
    @endforeach
@endsection
