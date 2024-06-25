<?php

declare(strict_types=1);

use App\Livewire\Admin\Components\RolesAndPermissions\RolesTable;
use App\Models\Role;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(RolesTable::class)
        ->assertStatus(200);
});

it('deletes role successfully', function () {
    $role = Role::factory()->create();

    Livewire::test(RolesTable::class)
        ->assertStatus(200)
        ->call('delete', id: $role->id)
        ->assertDispatched('flash-message')
        ->assertRedirect();

    assertDatabaseMissing('roles', ['id' => $role->id]);
});
