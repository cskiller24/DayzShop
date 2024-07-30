<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Components\RolesAndPermissions;

use App\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\View\View;
use Livewire\Component;

class PermissionsTable extends Component
{
    public function update(string $id, string $name): void
    {
        $this->authorize('update', Permission::class);

        $validated = Validator::make([
            'name' => $name,
        ], [
            'name' => ['required', 'string', 'max:255'],
        ])->validate();

        Permission::query()->findOrFail($id)->update($validated);

        $this->dispatch('flash-message', message: 'Permission Updated');
    }

    public function delete(string $id): void
    {
        $this->authorize('delete', Permission::class);
        
        Permission::query()->findOrFail($id)->delete();

        $this->dispatch('flash-message', message: 'Permission Deleted');
    }

    public function render(): View
    {
        return view('livewire.admin.components.roles-and-permissions.permissions-table', [
            'permissions' => Permission::query()->paginate(),
        ]);
    }
}
