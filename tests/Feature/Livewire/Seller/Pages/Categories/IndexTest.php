<?php

declare(strict_types=1);

use App\Livewire\Components\Toaster;
use App\Livewire\Seller\Pages\Categories\Index;
use App\Models\Store;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(Index::class)
        ->assertStatus(200);
});

it('creates a category', function () {
    $store = Store::factory()->create();
    $seller = User::factory()
        ->seller()
        ->createQuietly([
            'active_store_id' => $store->id,
        ]);

    Livewire::actingAs($seller)
        ->test(Index::class)
        ->set('name', 'test category')
        ->call('create')
        ->assertDispatched(Toaster::EVENT)
        ->assertDispatched('category-created');

    assertDatabaseHas('categories', ['name' => 'test category']);
});
