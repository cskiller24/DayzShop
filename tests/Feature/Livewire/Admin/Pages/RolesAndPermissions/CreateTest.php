<?php

declare(strict_types=1);

use App\Livewire\Admin\Pages\RolesAndPermissions\Create;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Create::class)
        ->assertStatus(200);
});
