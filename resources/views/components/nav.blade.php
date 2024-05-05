<nav class=" bg-secondary dark:bg-primary fixed w-full z-20 top-0 start-0 dark:border-gray-600">
    <div class="flex flex-wrap items-center justify-between mx-auto py-2 container">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            {{-- <picture class="w-auto h-0 mx-auto">
                <source srcset="{{ asset('assets/logo/secondary.svg') }}" media="(prefers-color-scheme: dark)">
                <source srcset="{{ asset('assets/logo/primary.svg') }}" media="(prefers-color-scheme: light)">
                <img src="{{ asset('assets/logo/primary.svg') }}" class="w-auto h-10" alt="Logo">
            </picture> --}}
            <span
                class="self-center text-2xl font-semibold whitespace-nowrap dark:text-secondary text-white">DayzShop</span>
        </a>
        <div class="flex md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
            @guest
                <x-base::button>
                    Login
                </x-base::button>
            @endguest
            <button data-collapse-toggle="navbar-sticky" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                aria-controls="navbar-sticky" aria-expanded="false">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M1 1h15M1 7h15M1 13h15" />
                </svg>
            </button>
        </div>
        <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1 transition-all"
            id="navbar-sticky">
            <ul
                class="flex flex-col p-4 md:p-0 mt-4 font-medium dark:border-secondary-900 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 ">
                @foreach (['Home', 'About', 'Services', 'Contact'] as $link)
                    <li>
                        <x-base::nav-link>
                            {{ $link }}
                        </x-base::nav-link>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>
