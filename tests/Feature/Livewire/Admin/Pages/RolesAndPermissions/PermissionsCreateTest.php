<?php

declare(strict_types=1);

use App\Livewire\Admin\Pages\RolesAndPermissions\PermissionsCreate;
use App\Models\Permission;
use Livewire\Livewire;
use function Pest\Laravel\withoutVite;
use function PHPUnit\Framework\assertTrue;

beforeEach(function () {
    $this->admin = seedAdmin();
    withoutVite();
});
it('renders successfully', function () {
    Livewire::actingAs($this->admin)
        ->test(PermissionsCreate::class)
        ->assertStatus(200);
});

it('successfully creates permission', function () {
    Livewire::actingAs($this->admin)
        ->test(PermissionsCreate::class)
        ->assertStatus(200)
        ->set('name', fake()->word())
        ->set('verbs', fake()->randomElements(Permission::VERBS, count: mt_rand(1, 3)))
        ->call('create')
        ->assertDispatched('flash-message')
        ->assertRedirect();

    assertTrue(Permission::query()->count() > 0);
});
