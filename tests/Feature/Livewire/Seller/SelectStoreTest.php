<?php

declare(strict_types=1);

use App\Livewire\Seller\SelectStore;
use App\Models\Store;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\withoutVite;
use function PHPUnit\Framework\assertNotNull;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    $user = User::factory()
        ->seller()
        ->has(Store::factory()->count(2))
        ->create();

    Livewire::actingAs($user)
        ->test(SelectStore::class)
        ->assertStatus(200);
});

it('redirects the seller to select a store', function () {
    $user = User::factory()
        ->seller()
        ->has(Store::factory()->count(2))
        ->create();

    actingAs($user);

    get(route('seller'))->assertRedirect(route('seller.select'));
});

it('successfully selects a store', function () {
    /** @var \App\Models\User $user */
    $user = User::factory()
        ->seller()
        ->hasStores()
        ->create();

    $store = $user->stores()->first();

    Livewire::actingAs($user)
        ->test(SelectStore::class)
        ->assertStatus(200);

    post(route('seller.activate', $store->id))
        ->assertRedirect();

    get(route('seller'))->assertOk();

    assertNotNull($user->refresh()->active_store_id);
});
