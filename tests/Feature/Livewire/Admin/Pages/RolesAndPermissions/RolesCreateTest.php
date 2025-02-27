<?php

declare(strict_types=1);

use App\Livewire\Admin\Pages\RolesAndPermissions\RolesCreate;
use App\Models\Permission;
use App\Models\Role;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;
use function PHPUnit\Framework\assertTrue;

beforeEach(function () {
    $this->admin = seedAdmin();
    withoutVite();
});

it('renders successfully', function () {
    Livewire::actingAs($this->admin)
        ->test(RolesCreate::class)
        ->assertStatus(200);
});

it('creates a role', function () {
    $permissions = Permission::factory()->count(3)->create();

    Livewire::actingAs($this->admin)
        ->test(RolesCreate::class)
        ->assertStatus(200)
        ->set('name', fake()->name())
        ->set('permissions', $permissions->pluck('id')->toArray())
        ->call('create')
        ->assertDispatched('flash-message')
        ->assertRedirect();

    assertTrue(Role::count() > 0);
});
