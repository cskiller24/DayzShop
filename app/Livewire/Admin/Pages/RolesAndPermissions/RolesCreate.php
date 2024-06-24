<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Pages\RolesAndPermissions;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.roles.admin')]
class RolesCreate extends Component
{
    public function render(): View
    {
        return view('livewire.admin.pages.roles-and-permissions.roles-create');
    }
}
