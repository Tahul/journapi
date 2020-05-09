<span class="block text-gray-800 text-sm font-bold mb-4">Danger zone</span>


<ul class="list-inside text-sm">
    <li class="mb-4 flex justify-between">
        <svg
            class="w-4 h-4"
            fill="#000000"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 16 16"
            width="32px"
            height="32px"
        >
            <path
                d="M 2.5 1 C 1.675781 1 1 1.675781 1 2.5 L 1 12.5 C 1 13.324219 1.675781 14 2.5 14 L 12.5 14 C 13.324219 14 14 13.324219 14 12.5 L 14 10 L 13 11 L 13 12.5 C 13 12.78125 12.78125 13 12.5 13 L 2.5 13 C 2.21875 13 2 12.78125 2 12.5 L 2 2.5 C 2 2.21875 2.21875 2 2.5 2 L 12.5 2 C 12.78125 2 13 2.21875 13 2.5 L 13 4 L 14 5 L 14 2.5 C 14 1.675781 13.324219 1 12.5 1 Z M 10.730469 4.023438 L 10.019531 4.726563 L 12.292969 7 L 5 7 L 5 8 L 12.292969 8 L 10.019531 10.269531 L 10.730469 10.980469 L 14.207031 7.5 Z"
            />
        </svg>


        <a
            class="text-sm"
            href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        >
            Logout
        </a>
    </li>

    <li class="flex justify-between">
        <svg
            class="w-4 h-4"
            fill="#000000"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 16 16"
            width="32px"
            height="32px"
        >
            <path
                d="M 6.496094 1 C 5.675781 1 5 1.675781 5 2.496094 L 5 3 L 2 3 L 2 4 L 3 4 L 3 12.5 C 3 13.324219 3.675781 14 4.5 14 L 10.5 14 C 11.324219 14 12 13.324219 12 12.5 L 12 4 L 13 4 L 13 3 L 10 3 L 10 2.496094 C 10 1.675781 9.324219 1 8.503906 1 Z M 6.496094 2 L 8.503906 2 C 8.785156 2 9 2.214844 9 2.496094 L 9 4 L 11 4 L 11 12.5 C 11 12.78125 10.78125 13 10.5 13 L 4.5 13 C 4.21875 13 4 12.78125 4 12.5 L 4 4 L 6 4 L 6 2.496094 C 6 2.214844 6.214844 2 6.496094 2 Z M 5.726563 6.023438 L 5.023438 6.726563 L 6.792969 8.5 L 5.023438 10.269531 L 5.726563 10.980469 L 7.5 9.207031 L 9.273438 10.980469 L 9.976563 10.269531 L 8.207031 8.5 L 9.976563 6.726563 L 9.273438 6.023438 L 7.5 7.792969 Z"
            />
        </svg>


        <a
            class="text-sm"
            href="{{ route('logout') }}"
            onclick="event.preventDefault(); document.getElementById('delete-form').submit();"
        >
            Delete my account
        </a>
    </li>
</ul>

<form id="logout-form" class="hidden" action="{{ route('logout') }}" method="POST">
    {{ csrf_field() }}
</form>

<form id="delete-form" action="{{ route('delete-account') }}" method="GET">
    {{ csrf_field() }}
</form>
