<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Components\RolesAndPermissions;

use App\Models\Role;
use Illuminate\View\View;
use Livewire\Component;

class RolesTable extends Component
{
    public function delete(string $id): void
    {
        $this->authorize('delete', Role::class);

        Role::query()->findOrFail($id)->delete();

        $this->dispatch('flash-message', message: 'Role deleted successfully.');

        $this->redirect(route('admin.roles-and-permissions'));
    }

    public function render(): View
    {
        return view('livewire.admin.components.roles-and-permissions.roles-table', [
            'roles' => Role::query()->paginate(),
        ]);
    }
}
