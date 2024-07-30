<?php

declare(strict_types=1);

use App\Livewire\Admin\Pages\RolesAndPermissions\RolesUpdate;
use App\Models\Permission;
use App\Models\Role;
use Livewire\Livewire;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    $this->admin = seedAdmin();
    $this->role = Role::first();
    withoutVite();
});

it('renders successfully', function () {
    Livewire::actingAs($this->admin)
        ->test(RolesUpdate::class, ['role' => $this->role->id])
        ->assertStatus(200);
});

it('successfully updates role', function () {
    $name = fake()->word();
    Livewire::actingAs($this->admin)
        ->test(RolesUpdate::class, ['role' => $this->role->id])
        ->assertStatus(200)
        ->set('name', $name)
        ->set('permissions', Permission::all()->pluck('id')->toArray())
        ->call('update')
        ->assertDispatched('flash-message')
        ->assertRedirect();

    assertDatabaseHas('roles', ['id' => $this->role->id, 'name' => $name]);
});
