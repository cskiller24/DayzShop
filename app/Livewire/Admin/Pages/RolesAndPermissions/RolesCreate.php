<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Pages\RolesAndPermissions;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.roles.admin')]
class RolesCreate extends Component
{
    #[Validate(['required', 'string', 'max:255'])]
    public string $name;

    /**
     * @var array <int, string>
     */
    #[Validate([
        'permissions' => ['required', 'array'],
        'permissions.*' => ['exists:permissions,id'],
    ])]
    public array $permissions;

    public function create(): void
    {
        $data = $this->validate();

        Role::query()->create(['name' => $data['name']])->syncPermissions($data['permissions']);

        $this->dispatch('flash-message', message: 'Role created successfully');

        $this->redirect(route('admin.roles-and-permissions'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.roles-and-permissions.roles-create', [
            'availablePermissions' => Permission::all()->groupBy('permission_name'),
        ]);
    }
}
