<?php

declare(strict_types=1);

use App\Livewire\Customer\Components\CartCard;
use App\Models\Cart;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    $cart = Cart::factory()->createQuietly();

    Livewire::test(CartCard::class, ['cart' => $cart])
        ->assertStatus(200);
});

it('increments quantity in a cart', function () {
    $cart = Cart::factory()->createQuietly(['quantity' => 1]);

    Livewire::actingAs($cart->user)
        ->test(CartCard::class, ['cart' => $cart])
        ->assertStatus(200)
        ->call('increment');

    assertDatabaseHas('carts', ['id' => $cart->id, 'quantity' => 2]);
});

it('decrements quantity in a cart', function () {
    $cart = Cart::factory()->createQuietly(['quantity' => 2]);

    Livewire::actingAs($cart->user)
        ->test(CartCard::class, ['cart' => $cart])
        ->assertStatus(200)
        ->call('decrement');

    assertDatabaseHas('carts', ['id' => $cart->id, 'quantity' => 1]);
});
