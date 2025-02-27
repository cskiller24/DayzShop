<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Pages\RolesAndPermissions;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.roles.admin')]
class RolesUpdate extends Component
{
    #[Locked]
    public string $id;

    #[Validate(['required', 'string', 'max:255'])]
    public string $name;

    /**
     * @var array<int, string>
     */
    #[Validate([
        'permissions' => ['required', 'array'],
        'permissions.*' => ['exists:permissions,id'],
    ])]
    public array $permissions;

    public function mount(Role $role): void
    {
        $this->id = $role->id;
        $this->name = $role->name;
        $this->permissions = $role->permissions->pluck('id')->toArray(); // @phpstan-ignore-line
    }

    public function update(): void
    {
        $this->authorize('update', Role::class);

        $data = $this->validate();

        $role = Role::query()->findOrFail($this->id);
        $role->update(['name' => $data['name']]);
        $role->syncPermissions($data['permissions']);

        $this->dispatch('flash-message', message: 'Role updated successfully');

        $this->redirect(route('admin.roles-and-permissions'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.roles-and-permissions.roles-update', [
            'availablePermissions' => Permission::all()->groupBy('permission_name'),
        ]);
    }
}
