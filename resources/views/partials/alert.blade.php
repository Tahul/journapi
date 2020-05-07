@if (session('success'))
    <div
        onClick="removeAlert()"
        id="alert"
        class="alert success"
        role="alert">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div
        onClick="removeAlert()"
        id="alert"
        class="alert error"
        role="alert">
        {{ session('error') }}
    </div>
@endif
