<?php

declare(strict_types=1);

use App\Livewire\Courier\Home;
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
    actingAs(User::factory()->courier()->create());

    get(route('courier'))->assertOk();
});

it('it redirects when the user is not admin', function () {
    actingAs(User::factory()->create());

    get(route('courier'))
        ->assertRedirect();
});
