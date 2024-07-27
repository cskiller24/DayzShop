<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Pages\RolesAndPermissions;

use App\Models\Permission;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.roles.admin')]
class PermissionsCreate extends Component
{
    #[Validate('required')]
    public string $name;

    /**
     * @var array<int, string>
     */
    #[Validate('required', 'array')]
    public array $verbs;

    public function create(): void
    {
        $this->authorize('create', Permission::class);
        
        $data = $this->validate();
        $name = str($data['name'])->lower()->snake();

        /**
         * @var Collection<int, string> $verbs
         */
        $verbs = new Collection($data['verbs']);
        $verbs->each(function (string $verb) use ($name): void {
            $verb = str($verb)->lower()->snake();
            $separator = Permission::SEPARATOR;

            Permission::create(['name' => "{$name}{$separator}{$verb}"]);
        });

        $this->dispatch('flash-message', message: 'Permission created successfully');

        $this->redirect(route('admin.roles-and-permissions'), navigate: true);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.roles-and-permissions.permissions-create');
    }
}
