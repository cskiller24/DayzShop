<div class="card">
    <form class="card-body" wire:submit="update">
        <div class="d-flex justify-content-end">
            <x-base.button class="border-light">
                <i class="ti ti-plus"></i> Update Role
            </x-base.button>
        </div>

        <div class="mb-2">
            <x-base.label>Name</x-base.label>
            <x-base.text-input wire:model="name" errorKey="name"/>
            <x-base.error key="name"/>
        </div>
        <div @class(['is-invalid' => $errors->first('permissions')])></div>
        <x-base.error key="permissions"/>
        <div class="row">
            @foreach($availablePermissions as $permissionName => $permissionVerbs)
                <div class="col-12 col-md-6">
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <h3>
                                        <x-base.label>{{ str($permissionName)->title() }}</x-base.label>
                                    </h3>
                                </div>
                                @foreach ($permissionVerbs as $permission)
                                    <div class="col-4">
                                        <label class="form-check">
                                            <input
                                                class="form-check-input"
                                                wire:model="permissions"
                                                name="permissions[]" type="checkbox"
                                                value="{{ $permission->id }}">
                                            <span
                                                class="form-check-label"
                                                id="{{ $permission->id }}">
                                            {{ str($permission->verb_name)->title() }}
                                        </span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </form>
</div>
