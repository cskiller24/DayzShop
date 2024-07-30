<?php

declare(strict_types=1);

use App\Livewire\Components\Toaster;
use App\Livewire\Seller\Pages\Products\Edit;
use App\Models\Product;
use Livewire\Livewire;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    $this->seller = seedSeller();
    setPermissionsTeamId($this->seller->active_store_id);
    withoutVite();

    $this->product = Product::whereStoreId($this->seller->active_store_id)->first();
});

it('renders successfully', function () {
    Livewire::actingAs($this->seller)
        ->test(Edit::class, ['product' => $this->product])
        ->assertStatus(200);
});

it('edits a product', function () {
    $category = \App\Models\Category::whereStoreId($this->seller->active_store_id)->first();

    Livewire::actingAs($this->seller)
        ->test(Edit::class, ['product' => $this->product])
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
