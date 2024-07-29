<?php

declare(strict_types=1);

use App\Livewire\Customer\Pages\ProcessCart;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use Livewire\Livewire;

use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    $productVariant = ProductVariant::factory()
        ->createQuietly();

    $customer = User::factory()->customer()->create();

    $customer->carts()->create(['product_variant_id' => $productVariant->id, 'quantity' => 1]);

    Livewire::actingAs($customer)
        ->test(ProcessCart::class)
        ->assertStatus(200);
});

it('deletes cart successfully', function () {
    $productVariant = ProductVariant::factory()
        ->createQuietly();

    $customer = User::factory()->customer()->create();

    $customer->carts()->create(['product_variant_id' => $productVariant->id, 'quantity' => 1]);

    Livewire::actingAs($customer)
        ->test(ProcessCart::class)
        ->call('deleteCart', $customer->carts->first()->id)
        ->assertStatus(200);

    assertDatabaseMissing('carts', ['id' => $customer->carts->first()->id]);
});

it('throws model not found exception when cart does not exists', function () {
    $productVariant = ProductVariant::factory()
        ->createQuietly();

    $customer = User::factory()->customer()->create();

    $customer->carts()->create(['product_variant_id' => $productVariant->id, 'quantity' => 1]);

    $randomCart = Str::uuid();

    assertDatabaseMissing('carts', ['id' => $randomCart]);

    Livewire::actingAs($customer)
        ->test(ProcessCart::class)
        ->call('deleteCart', $randomCart);

})->throws(ModelNotFoundException::class);
