<div>
    <x-slot name="sideHeader">
        <a class="border-light btn btn-dark" href="{{ route('seller.products.create') }}" wire:navigate>
            <i class="ti ti-plus me-1"></i>Product
        </a>
    </x-slot>
    <livewire:seller.components.products.table/>
</div>
