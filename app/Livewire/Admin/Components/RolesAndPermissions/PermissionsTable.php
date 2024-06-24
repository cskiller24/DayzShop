<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Components\RolesAndPermissions;

use App\Models\Permission;
use Illuminate\View\View;
use Livewire\Component;

class PermissionsTable extends Component
{
    public function render(): View
    {
        return view('livewire.admin.components.roles-and-permissions.permissions-table', [
            'permissions' => Permission::query()->paginate(),
        ]);
    }
}
