<?php

declare(strict_types=1);

use App\Livewire\Components\Toaster;
use App\Livewire\Seller\Pages\Products\Create;
use App\Models\Category;
use App\Models\Store;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(Create::class)
        ->assertStatus(200);
});

it('creates product successfully', function () {
    $store = Store::factory()->create();
    $category = Category::factory()->createQuietly(['store_id' => $store->id]);
    $seller = User::factory()->seller()->create(['active_store_id' => $store->id]);

    Livewire::actingAs($seller)
        ->test(Create::class)
        ->set('name', fake()->name())
        ->set('description', fake()->words(asText: true))
        ->set('specifications', [
            ['key' => fake()->word(), 'value' => fake()->words(asText: true)],
        ])
        ->set('categories', [$category->id])
        ->call('create')
        ->assertDispatched(Toaster::EVENT)
        ->assertRedirect();
});
