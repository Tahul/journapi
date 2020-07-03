<div class="pb-6">
    <div
        class="box" x-data="{ visible: localStorage.getItem('journal-write-visible') === 'true' }"
    >
        <div
            class="box-header flex justify-between cursor-pointer"
            @click="
                    localStorage.setItem('journal-write-visible', !visible);
                    visible = !visible;
                "
        >
            Write in my journal

            <img
                class="w-4 h-4 block transform transition-transform duration-200 rotate-180 ease-in"
                :class="{ 'rotate-180': visible }" src="/images/chevron.svg"
                alt="chevron"
            />
        </div>

        <div class="box-inside" x-show.transition="visible">
            <form wire:submit.prevent="submit" novalidate>
                @include('partials.alerts')

                @csrf

                <div class="form-field">
                    <textarea
                        class="form-textarea w-full @error('bullet') error @enderror"
                        name="bullet"
                        id="bullet-input"
                        autofocus
                        rows="3"
                        wire:model.lazy="bullet"
                    ></textarea> <!-- Edit bullet -->

                    <input
                        class="form-input w-full mt-2"
                        max="false"
                        min="false"
                        type="datetime-local"
                        wire:model.lazy="published_at"
                    /> <!-- Edit published at -->

                    @error('bullet')
                    <p>
                        {{ $message }}
                    </p>
                    @enderror
                </div>

                <button
                    class="button w-full" @click="document.querySelector('#bullet-input').focus()"
                >
                    Add to my journal
                </button>
            </form>
        </div>
    </div>


    @foreach($bullets as $date => $values)
        <div
            x-data="{ visible: parseInt('{{ $date === now(auth()->user()->timezone)->format('d M y') }}') === 1 }"
        >
            <h3
                class="p-3 my-6 w-full bg-indigo-400 rounded-lg font-bold text-white cursor-pointer flex justify-between items-center select-none border-4 border-indigo-400"
                @click="visible = !visible"
            >
                {{ $date }}

                <img
                    class="w-4 h-4 block transform transition-transform duration-200 ease-in rotate-180"
                    :class="{ 'rotate-180': visible }" src="/images/chevron.svg"
                    alt="chevron"
                />
            </h3>

            <div
                x-show.transition="visible === true"
            >
                @foreach($values as $bullet)
                    <livewire:bullet :bullet="$bullet" :key="rand() * $bullet->id">
                @endforeach
            </div>
        </div>
    @endforeach
</div>
