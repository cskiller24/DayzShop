<?php

declare(strict_types=1);

use App\Livewire\Components\Toaster;
use App\Livewire\Seller\Pages\Products\Edit;
use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use App\Models\User;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Edit::class, ['product' => Product::factory()->createQuietly()])
        ->assertStatus(200);
});

it('edits a product', function () {
    $store = Store::factory()->create();

    $category = Category::factory()->createQuietly(['store_id' => $store->id]);
    $product = Product::factory()->createQuietly(['store_id' => $store->id]);
    $product->categories()->attach($category->id);

    $seller = User::factory()
        ->seller()
        ->create(['active_store_id' => $store->id]);

    $seller->stores()->save($store);

    Livewire::actingAs($seller)
        ->test(Edit::class, ['product' => $product])
        ->set('name', fake()->name())
        ->set('description', fake()->words(asText: true))
        ->set('specifications', [
            ['key' => fake()->word(), 'value' => fake()->words(asText: true)],
        ])
        ->set('categories', [$category->id])
        ->call('update')
        ->assertDispatched(Toaster::EVENT)
        ->assertRedirect();
});
