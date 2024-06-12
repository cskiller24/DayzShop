<aside id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto dark:bg-white dark:text-secondary-600 text-primary">
        <a href="https://flowbite.com/" class="flex items-center ps-6 mb-5">
            <x-base::logo class="w-12 h-12 me-3" imgClass="w-auto" reversed />
            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-secondary">Dayzshop</span>
        </a>
        <ul class="space-y-2 font-medium">
            @foreach ($this->items() as $item)
                <li>
                    <a href="{{ $item['url'] }}" wire:navigate
                        class="flex items-center p-2 rounded-lg hover:bg-secondary dark:hover:bg-primary group">
                        @svg('heroicon-' . $item['icon'], ['class' => 'flex-shrink-0 w-6 h-6 transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white'])
                        <span class="ms-3">{{ $item['title'] }}</span>
                    </a>
                </li>
            @endforeach
            <li>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button
                        class="flex items-center p-2 rounded-lg hover:bg-secondary dark:hover:bg-primary group w-full">
                        @svg('heroicon-s-arrow-right-start-on-rectangle', ['class' => 'flex-shrink-0 w-6 h-6 transition duration-75 group-hover:text-gray-900 dark:group-hover:text-white'])
                        <span class="ms-3">Sign Out</span>
                    </button>
                </form>
            </li>
        </ul>
    </div>
</aside>
