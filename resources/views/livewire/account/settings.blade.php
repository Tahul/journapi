<div class="mb-6 box">
    <div class="box-header">
        Settings
    </div>

    <div class="box-inside">
        @include('partials.alerts')

        <div class="form-field"> <!-- Name -->
            <label for="Name">
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
                wire:model="name"
            >

            @error('name')
            <p>
                {{ $message }}
            </p>
            @enderror
        </div>

        <div class="form-field"> <!-- Timezone -->
            <label for="timezone">
                {{ __('Timezone') }}
            </label>

            <select class="form-input w-full" name="timezone" id="timezone" wire:model.lazy="timezone">
                @foreach($timezones as $zone)
                    <option value="{{ $zone }}">{{ $zone }}</option>
                @endforeach
            </select>

            @error('timezone')
            <p>
                {{ $message }}
            </p>
            @enderror
        </div>

        <form wire:submit.prevent="regenerateApiKey">
            <div class="form-field">
                <label for="apiKey">
                    {{ __('API Key') }}
                </label>

                <textarea
                    id="apiKey"
                    type="text"
                    class="form-input shadow-none focus:shadow-none focus:border-gray-300 rounded-b-none focus:outline-none outline-none w-full resize-none disabled @error('apiKey') error @enderror"
                    name="apiKey" value="{{ old('apiKey') }}"
                    readonly
                    wire:model="apiKey"
                ></textarea>

                <div class="flex items-center w-full">
                    <div
                        class="cursor-pointer copy-btn button input-action left w-1/2 flex-1"
                        data-clipboard-target="#apiKey"
                    >
                        Copy
                    </div>
                    <button class="button green input-action right w-1/2 flex-1" type="submit">
                        Refresh
                    </button>
                </div>
            </div>
        </form>

        <div class="mb-6">
            @include('partials.recipes')
        </div>

        <div class="mb-6">
            @include('partials.danger-zone')
        </div>

        <div>
            @include('partials.buymeacoffee')
        </div>
    </div>
</div>
