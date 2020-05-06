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
