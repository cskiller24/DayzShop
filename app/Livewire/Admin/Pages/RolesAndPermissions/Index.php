<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Pages\RolesAndPermissions;

use App\Models\Role;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.roles.admin')]
class Index extends Component
{
    public function mount(): void
    {
        $this->authorize('viewAny', Role::class);
    }
    public function render(): View
    {
        return view('livewire.admin.pages.roles-and-permissions.index');
    }
}
