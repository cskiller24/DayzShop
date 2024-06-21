@props([
    'header' => null,
    'footer' => null,
])

<x-layouts.base>
    <livewire:components.toaster />
    <div class="page bg-dark text-light">
        <x-admin.sidebar />
        <div class="page-wrapper">
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <div class="page-pretitle">
                                {{ $headerPretitle ?? 'Overview' }}
                            </div>
                            <h2 class="page-title">
                                {{ $headerTitle ?? 'Admin' }}
                            </h2>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            <div class="btn-list">
                                {{ $sideheader ?? null}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
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
