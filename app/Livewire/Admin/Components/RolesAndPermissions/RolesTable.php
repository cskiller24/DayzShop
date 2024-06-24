<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Components\RolesAndPermissions;

use App\Models\Role;
use Illuminate\View\View;
use Livewire\Component;

class RolesTable extends Component
{
    public function render(): View
    {
        return view('livewire.admin.components.roles-and-permissions.roles-table', [
            'roles' => Role::query()->paginate(),
        ]);
    }
}
