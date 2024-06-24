<?php

declare(strict_types=1);

use App\Livewire\Admin\Pages\RolesAndPermissions\RolesCreate;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(RolesCreate::class)
        ->assertStatus(200);
});
