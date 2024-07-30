<?php

declare(strict_types=1);

use App\Livewire\Components\Toaster;
use App\Livewire\Seller\Pages\Products\Create;
use App\Models\Category;
use Livewire\Livewire;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    $this->seller = seedSeller();
    setPermissionsTeamId($this->seller->active_store_id);
    withoutVite();
});

it('renders successfully', function () {
    Livewire::actingAs($this->seller)
        ->test(Create::class)
        ->assertStatus(200);
});

it('creates product successfully', function () {
    $category = Category::whereStoreId($this->seller->active_store_id)->first();

    Livewire::actingAs($this->seller)
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
