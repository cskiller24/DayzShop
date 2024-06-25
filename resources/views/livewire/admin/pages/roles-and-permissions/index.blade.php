<div>
    <x-slot name="headerTitle">
        Roles and Permissions
    </x-slot>
    <x-slot name="sideheader">
        <a class="btn btn-dark border-light" href="{{ route('admin.roles-and-permissions.permissions.create') }}"
           wire:navigate>
            <i class="ti ti-plus me-1"></i> Permissions
        </a>
        <a class="btn btn-dark border-light" href="{{ route('admin.roles-and-permissions.roles.create') }}"
           wire:navigate>
            <i class="ti ti-plus me-1"></i> Roles
        </a>
    </x-slot>


    <div class="border-light-subtle border rounded p-1">
        <h1 class="ms-1 mb-0">Roles</h1>
        <livewire:admin.components.roles-and-permissions.roles-table/>
    </div>

    <div class="border-light-subtle border rounded p-1">
        <h1 class="ms-1 mb-0">Permissions</h1>
        <livewire:admin.components.roles-and-permissions.permissions-table/>
    </div>
</div>
