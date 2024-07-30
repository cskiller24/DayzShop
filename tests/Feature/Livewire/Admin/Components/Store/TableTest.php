<?php

declare(strict_types=1);

use App\Livewire\Admin\Components\Store\Table;
use App\Models\Store;
use Livewire\Livewire;
use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    $this->admin = seedAdmin();
    setPermissionsTeamId(\App\Models\Permission::DEFAULT_ADMIN_TEAM);
    withoutVite();
});

it('renders blank store successfully', function () {
    Livewire::actingAs($this->admin)
        ->test(Table::class)
        ->assertStatus(200)
        ->assertSee('No store available.');
});

it('renders store successfully', function () {
    $stores = Store::factory()->count(10)->create();

    Livewire::actingAs($this->admin)
        ->test(Table::class)
        ->assertStatus(200)
        ->assertViewHas('stores', function ($stores) {
            return $stores->count() > 0;
        });
});

it('deletes store successfully', function () {
    $stores = Store::factory()->count(10)->create();

    Livewire::actingAs($this->admin)
        ->test(Table::class)
        ->assertStatus(200)
        ->assertViewHas('stores', function ($stores) {
            return $stores->count() > 0;
        })
        ->call('delete', id: $stores->first()->id)
        ->assertDispatched('flash-message', message: 'Deleted store successfully');

    assertDatabaseMissing('stores', ['id' => $stores->first()->id]);
});
