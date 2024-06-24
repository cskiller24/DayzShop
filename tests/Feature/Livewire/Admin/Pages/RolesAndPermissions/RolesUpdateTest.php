<?php

declare(strict_types=1);

use App\Livewire\Admin\Pages\RolesAndPermissions\RolesUpdate;
use App\Models\Permission;
use App\Models\Role;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseHas;

it('renders successfully', function () {
    $role = Role::factory()->withPermissions()->create();

    Livewire::test(RolesUpdate::class, ['role' => $role->id])
        ->assertStatus(200);
});

it('successfully updates role', function () {
    $role = Role::factory()->withPermissions()->create();
    $permissions = Permission::factory()->count(3)->create();

    $name = fake()->word();
    Livewire::test(RolesUpdate::class, ['role' => $role->id])
        ->assertStatus(200)
        ->set('name', $name)
        ->set('permissions', $permissions->pluck('id')->toArray())
        ->call('update')
        ->assertDispatched('flash-message')
        ->assertRedirect();

    assertDatabaseHas('roles', ['id' => $role->id, 'name' => $name]);
});
