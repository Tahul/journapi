<span class="block text-gray-800 text-sm font-bold mb-4">Danger zone</span>

<a
    class="text-sm"
    href="{{ route('logout') }}"
    onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
>
    Logout
</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>
