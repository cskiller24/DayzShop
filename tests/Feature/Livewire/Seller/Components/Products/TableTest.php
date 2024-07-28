<?php

declare(strict_types=1);

use App\Livewire\Components\Toaster;
use App\Livewire\Seller\Components\Products\Table;
use App\Models\Product;
use App\Models\User;
use Livewire\Livewire;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(Table::class)
        ->assertStatus(200);
});

it('deletes product successfully', function () {
    seedSeller();
    $seller = User::whereType('seller')->first();

    $product = Product::whereStoreId($seller->active_store_id)->first();

    Livewire::actingAs($seller)
        ->test(Table::class)
        ->assertStatus(200)
        ->call('delete', $product->id)
        ->assertDispatched(Toaster::EVENT);
});
