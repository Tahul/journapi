@extends('layouts.app')

@section('content')
    @include('partials.alert')

    <div class="pb-6">
        <div class="box" x-data="{ visible: false }">
            <div class="box-header flex justify-between cursor-pointer" @click="visible = !visible">
                Write in my journal

                <img
                    class="w-4 h-4 block transform transition-transform duration-200 ease-in"
                    :class="{ 'rotate-180': visible }" src="/images/chevron.svg"
                />
            </div>

            <div class="box-inside" x-show.transition="visible === true">
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
                    class="p-3 my-6 w-full bg-indigo-400 rounded-lg text-lg bold text-white cursor-pointer flex justify-between items-center select-none"
                    @click="visible = !visible"
                >
                    {{ $date }}

                    <img
                        class="w-4 h-4 block transform transition-transform duration-200 ease-in"
                        :class="{ 'rotate-180': visible }" src="/images/chevron.svg"
                    />
                </h3>

                @foreach($values as $bullet)
                    <div class="mt-6" x-show.transition="visible === true">
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
    </div>
@endsection
