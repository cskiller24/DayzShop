<?php

declare(strict_types=1);

use App\Livewire\Components\Toaster;
use App\Livewire\Customer\Pages\Products\Show;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\User;
use Livewire\Livewire;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseEmpty;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    $product = Product::factory()
        ->has(
            ProductVariant::factory()->count(2), 'variants'
        )->createQuietly();

    Livewire::test(Show::class, ['product' => $product])
        ->assertStatus(200);
});

it('add to cart successfully', function () {
    $customer = User::factory()->customer()->create();
    $product = Product::factory()
        ->has(
            ProductVariant::factory()->count(2), 'variants'
        )->createQuietly();

    Livewire::actingAs($customer)
        ->test(Show::class, ['product' => $product])
        ->assertStatus(200)
        ->set('productVariantId', ProductVariant::first()->id)
        ->call('addToCart')
        ->assertDispatched(Toaster::EVENT)
        ->assertDispatched('cart-added');

    assertDatabaseCount('carts', 1);
});

it('does not add to cart when not logged in', function () {
    $product = Product::factory()
        ->has(
            ProductVariant::factory()->count(2), 'variants'
        )->createQuietly();

    Livewire::test(Show::class, ['product' => $product])
        ->assertStatus(200)
        ->set('productVariantId', ProductVariant::first()->id)
        ->call('addToCart')
        ->assertDispatched(Toaster::EVENT, message: 'Please login first');

    assertDatabaseEmpty('carts');
});

it('does not add to cart on empty variant', function () {
    $customer = User::factory()->customer()->create();
    $product = Product::factory()
        ->has(
            ProductVariant::factory()->count(2), 'variants'
        )->createQuietly();

    Livewire::actingAs($customer)
        ->test(Show::class, ['product' => $product])
        ->assertStatus(200)
        ->call('addToCart')
        ->assertDispatched(Toaster::EVENT, message: 'Please specify a product variant');

    assertDatabaseEmpty('carts');
});
