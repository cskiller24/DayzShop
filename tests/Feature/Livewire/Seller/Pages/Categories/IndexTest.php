<?php

declare(strict_types=1);

use App\Livewire\Components\Toaster;
use App\Livewire\Seller\Pages\Categories\Index;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    $this->seller = seedSeller();
    setPermissionsTeamId($this->seller->active_store_id);
    withoutVite();
});

it('renders successfully', function () {
    Livewire::actingAs($this->seller)
        ->test(Index::class)
        ->assertStatus(200);
});

it('creates a category', function () {
    Livewire::actingAs($this->seller)
        ->test(Index::class)
        ->set('name', 'test category')
        ->call('create')
        ->assertDispatched(Toaster::EVENT)
        ->assertDispatched('category-created');

    assertDatabaseHas('categories', ['name' => 'test category']);
});
