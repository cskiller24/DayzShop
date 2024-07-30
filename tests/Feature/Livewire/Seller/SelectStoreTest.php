<?php

declare(strict_types=1);

use App\Livewire\Seller\SelectStore;
use Livewire\Livewire;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\withoutVite;
use function PHPUnit\Framework\assertNotNull;

beforeEach(function () {
    $this->seller = seedSeller();
    withoutVite();
});

it('renders successfully', function () {
    $this->seller->update(['active_store_id' => null]);

    Livewire::actingAs($this->seller)
        ->test(SelectStore::class)
        ->assertStatus(200);
});

it('redirects the seller to select a store', function () {
    $this->seller->update(['active_store_id' => null]);

    actingAs($this->seller);

    get(route('seller'))->assertRedirect(route('seller.select'));
});

it('successfully selects a store', function () {
    $this->seller->update(['active_store_id' => null]);
    $store = \App\Models\Store::first();

    Livewire::actingAs($this->seller)
        ->test(SelectStore::class)
        ->assertStatus(200);

    post(route('seller.activate', $store->id))
        ->assertRedirect();

    get(route('seller'))->assertOk();

    assertNotNull($this->seller->refresh()->active_store_id);
});
