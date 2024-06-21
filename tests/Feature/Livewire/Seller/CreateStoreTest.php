<?php

declare(strict_types=1);

use App\Livewire\Seller\CreateStore;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\post;
use function Pest\Laravel\withoutVite;
use function PHPUnit\Framework\assertNotNull;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    $user = User::factory()->seller()->create();

    Livewire::actingAs($user)
        ->test(CreateStore::class)
        ->assertStatus(200);
});

it('succesfully creates a store', function () {
    $user = User::factory()->seller()->create();

    Livewire::actingAs($user)
        ->test(CreateStore::class)
        ->assertStatus(200)
        ->set('name', fake()->company())
        ->set('email', fake()->unique()->companyEmail())
        ->set('phoneNumber', fake()->phoneNumber())
        ->set('description', fake()->realText())
        ->call('validateFields')
        ->assertHasNoErrors()
        ->assertDispatched('validated');

    actingAs($user);

    $storeEmail = fake()->email();

    post(route('seller.store', [
        'name' => fake()->name(),
        'email' => $storeEmail,
        'phone_number' => fake()->phoneNumber(),
        'description' => fake()->realText(),
    ]))->assertRedirect(route('seller'));

    assertNotNull($user->refresh()->active_store_id);
    assertDatabaseHas('stores', ['email' => $storeEmail]);
});
