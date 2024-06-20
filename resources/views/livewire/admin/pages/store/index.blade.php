<div>
    <x-slot:sideheader>
        <a href="{{ route('admin.stores.create') }}" wire:navigate class="btn btn-dark border-light">
            <i class="ti ti-plus me-1"></i> Create store
        </a>
    </x-slot:sideheader>
    <livewire:admin.components.store.table />
</div>
