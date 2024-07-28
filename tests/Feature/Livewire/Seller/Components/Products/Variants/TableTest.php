<?php

declare(strict_types=1);

use App\Livewire\Components\Toaster;
use App\Livewire\Seller\Components\Products\Variants\Table;
use App\Models\Product;
use Livewire\Livewire;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    $this->seller = seedSeller();
    withoutVite();
});

it('renders successfully', function () {
    Livewire::actingAs($this->seller)
        ->test(Table::class)
        ->assertStatus(200);
});

it('deletes a product variant successfully', function () {
    $product = Product::factory()->hasVariants()->createQuietly();

    Livewire::test(Table::class, ['products' => $product])
        ->assertStatus(200)
        ->call('delete', $product->variants()->first()->id)
        ->assertDispatched('product-variant-deleted')
        ->assertDispatched(Toaster::EVENT);
});
