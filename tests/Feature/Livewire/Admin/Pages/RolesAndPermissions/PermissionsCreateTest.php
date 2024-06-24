<?php

declare(strict_types=1);

use App\Livewire\Admin\Pages\RolesAndPermissions\PermissionsCreate;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(PermissionsCreate::class)
        ->assertStatus(200);
});
