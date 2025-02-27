<?php

declare(strict_types=1);

use App\Livewire\Admin\Pages\RolesAndPermissions\Index;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;

it('renders successfully', function () {
    \Pest\Laravel\withoutExceptionHandling();
    withoutVite();

    Livewire::actingAs(seedAdmin())
        ->test(Index::class)
        ->assertStatus(200);
});
