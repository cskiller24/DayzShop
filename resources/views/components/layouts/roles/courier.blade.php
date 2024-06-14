@props([
    'header' => null,
    'footer' => null,
])

<x-layouts.base>
    <div class="page">
        <x-courier.sidebar />
        <!-- Navbar -->
        <x-courier.navbar />

        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    @if($header === null)
                        <x-base::default-vertical-header />
                    @else
                        {{ $header }}
                    @endif
                </div>
            </div>
            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    {{ $slot }}
                </div>
            </div>
            <footer class="footer footer-transparent d-print-none">
                <div class="container-xl">
                    @if($footer === null)
                        <x-base::default-footer />
                    @else
                        {{ $footer }}
                    @endif
                </div>
            </footer>
        </div>
    </div>
</x-layouts.base>
