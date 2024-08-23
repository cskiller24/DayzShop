<?php

declare(strict_types=1);

use App\Livewire\Admin\Components\RolesAndPermissions\PermissionsTable;
use App\Models\Permission;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    $this->admin = seedAdmin();
    setPermissionsTeamId(\App\Models\Permission::DEFAULT_ADMIN_TEAM);
    withoutVite();
});

it('renders successfully', function () {
    Livewire::actingAs($this->admin)
        ->test(PermissionsTable::class)
        ->assertStatus(200);
});

it('updates permission successfully', function () {
    $permission = Permission::factory()->create();

    $name = fake()->word();
    Livewire::actingAs($this->admin)
        ->test(PermissionsTable::class)
        ->assertStatus(200)
        ->call('update', id: $permission->id, name: $name)
        ->assertDispatched('flash-message');

    assertDatabaseHas('permissions', ['id' => $permission->id, 'name' => $name]);
});

it('deletes permission successfully', function () {
    $permission = Permission::factory()->create();

    Livewire::actingAs($this->admin)
        ->test(PermissionsTable::class)
        ->assertStatus(200)
        ->call('delete', id: $permission->id)
        ->assertDispatched('flash-message');

    assertDatabaseMissing('permissions', ['id' => $permission->id]);
});

it('does not update permissions on invalid id', function () {
    Livewire::actingAs($this->admin)
        ->test(PermissionsTable::class)
        ->assertStatus(200)
        ->call('update', id: fake()->uuid(), name: fake()->word())
        ->assertNotFound();
})->throws(ModelNotFoundException::class);

it('does not delete permissions on invalid id', function () {
    Livewire::actingAs($this->admin)
        ->test(PermissionsTable::class)
        ->assertStatus(200)
        ->call('delete', id: fake()->uuid())
        ->assertNotFound();
})->throws(ModelNotFoundException::class);
