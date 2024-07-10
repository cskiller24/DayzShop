<?php

declare(strict_types=1);

use App\Livewire\Customer\Components\ProductCard;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Storage::fake();
    $product = Product::factory()
        ->withImages()
        ->has(ProductVariant::factory(), 'variants')
        ->createQuietly();
    Livewire::test(ProductCard::class, ['product' => $product])
        ->assertStatus(200);
});
