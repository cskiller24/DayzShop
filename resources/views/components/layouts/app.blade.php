<x-layouts.base>
    <main class="min-h-screen flex flex-col justify-between">
        <header class="">
            <x-nav/>
        </header>
        <section>
            {{ $slot }}
        </section>
        <footer class="h-auto">
            <x-footer/>
        </footer>
    </main>
</x-layouts.base>

