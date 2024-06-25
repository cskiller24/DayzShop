<?php

declare(strict_types=1);

use App\Livewire\Admin\Pages\RolesAndPermissions\RolesCreate;
use App\Models\Permission;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(RolesCreate::class)
        ->assertStatus(200);
});

it('creates a role', function () {
    $permissions = Permission::factory()->count(3)->create();

    Livewire::test(RolesCreate::class)
        ->assertStatus(200)
        ->set('name', fake()->name())
        ->set('permissions', $permissions->pluck('id')->toArray())
        ->call('create')
        ->assertDispatched('flash-message')
        ->assertRedirect();

    assertDatabaseCount('roles', 1);
});
