<div class="box">
    <div class="box-header">
        Delete my account
    </div>

    <div class="box-inside">
        <p class="mb-6 text-sm">
            We're sorry to see you leave!
        </p>

        <p class="mb-6 text-sm">
            I sincerely hope you had a good experience writing your journal on Journapi.
        </p>

        <p class="mb-6 text-sm">
            Maybe before leaving, you would like to grab a
            <a class="font-bold cursor-pointer select-none" href="{{ route('json-export') }}" target="_blank">JSON
                export</a>
            of all your journal?
        </p>

        <p class="mb-6 text-sm">
            I wish you the best, goodbye! 👋
        </p>

        <button
            type="submit"
            class="button red w-full"
            wire:click="deleteAccount"
        >
            {{ __('Delete my account and data') }}
        </button>
    </div>
</div>
