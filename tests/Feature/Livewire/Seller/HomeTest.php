<?php

declare(strict_types=1);

use App\Livewire\Seller\Home;
use App\Models\User;
use Livewire\Livewire;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

test('it renders successfully', function () {
    Livewire::test(Home::class)
        ->assertStatus(200);
});

it('it renders successfully from route call', function () {
    actingAs(User::factory()->seller()->create());

    get(route('seller'))->assertOk();
});

it('it redirects when the user is not admin', function () {
    actingAs(User::factory()->create());

    get(route('seller'))
        ->assertRedirect();
});
