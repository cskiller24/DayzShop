<?php

declare(strict_types=1);

use App\Livewire\Components\Toaster;
use App\Livewire\Customer\Components\CartDropdown;
use App\Models\Cart;
use App\Models\ProductVariant;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(CartDropdown::class)
        ->assertStatus(200);
});

it('removes an item to cart', function () {
    $customer = User::factory()->customer()->create();

    $variant = ProductVariant::factory()->createQuietly();

    $cart = Cart::factory()->createQuietly([
        'product_variant_id' => $variant->id,
        'user_id' => $customer->id,
    ]);

    Livewire::actingAs($customer)
        ->test(CartDropdown::class)
        ->assertStatus(200)
        ->call('deleteCart', $cart->id)
        ->assertDispatched(Toaster::EVENT)
        ->assertDispatched('cart-deleted');

    assertDatabaseMissing('carts', ['id' => $cart->id]);
});
