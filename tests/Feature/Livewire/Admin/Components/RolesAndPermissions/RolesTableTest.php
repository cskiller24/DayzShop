<?php

declare(strict_types=1);

use App\Livewire\Admin\Components\RolesAndPermissions\RolesTable;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(RolesTable::class)
        ->assertStatus(200);
});
