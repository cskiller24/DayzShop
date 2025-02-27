<?php

declare(strict_types=1);

use App\Livewire\Seller\Pages\Products\Show;
use App\Models\Product;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    $seller = seedSeller();

    Livewire::actingAs($seller)
        ->test(Show::class, ['product' => Product::factory()->createQuietly(['store_id' => $seller->active_store_id])])
        ->assertStatus(200);
});
