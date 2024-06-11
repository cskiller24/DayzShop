<?php

use App\Livewire\Admin\Home;
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
    actingAs(User::factory()->admin()->create());

    get(route('admin'))->assertOk();
});

it('it redirects when the user is not admin', function () {
    actingAs(User::factory()->create());

    get(route('admin'))
        ->assertRedirect();
});


