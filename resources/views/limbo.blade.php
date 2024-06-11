<x-layouts.guest>
    The user doesn't seem to have any roles, please contact the admin.
    <form action="{{ route('logout') }}" method="post">
        @csrf
        <x-base::button type="submit" reversed>
            Logout
        </x-base::button>
    </form>
</x-layouts.guest>
