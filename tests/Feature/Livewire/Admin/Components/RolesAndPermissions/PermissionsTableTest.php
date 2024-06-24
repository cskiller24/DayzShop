<?php

declare(strict_types=1);

use App\Livewire\Admin\Components\RolesAndPermissions\PermissionsTable;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(PermissionsTable::class)
        ->assertStatus(200);
});
