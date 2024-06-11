<form action="{{ route('logout') }}" method="post">
    @csrf
    {{ $slot }}
</form>
