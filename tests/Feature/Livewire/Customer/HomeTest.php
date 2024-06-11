<?php
use App\Livewire\Customer\Home;
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
    actingAs(User::factory()->customer()->create());

    get(route('customer'))->assertOk();
});

it('it redirects when the user is not customer', function () {
    actingAs(User::factory()->seller()->create());

    get(route('customer'))
        ->assertRedirect();
});
