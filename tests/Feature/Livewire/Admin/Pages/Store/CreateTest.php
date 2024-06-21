<?php

declare(strict_types=1);

use App\Livewire\Admin\Pages\Store\Create;
use App\Models\User;
use Illuminate\Queue\CallQueuedClosure;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(Create::class)
        ->assertStatus(200);
});

it('creates a store', function () {
    Queue::fake();

    $sellers = User::factory()->count(10)->seller()->create();

    Livewire::test(Create::class)
        ->assertStatus(200)
        ->set('name', 'Test')
        ->set('description', fake()->realText())
        ->set('email', fake()->companyEmail())
        ->set('phoneNumber', fake()->phoneNumber())
        ->set('sellers', $sellers->pluck('id')->toArray())
        ->call('store')
        ->assertDispatched('flash-message')
        ->assertRedirect();

    Queue::assertPushedOn('after-response', CallQueuedClosure::class);
});
