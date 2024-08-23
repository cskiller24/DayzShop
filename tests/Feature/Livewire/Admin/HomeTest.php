<?php

declare(strict_types=1);

use App\Livewire\Admin\Home;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    seedAdmin();
    withoutVite();
    $this->admin = User::whereType('admin')->first();
});

test('it renders successfully', function () {
    Livewire::actingAs($this->admin)
        ->test(Home::class)
        ->assertStatus(200);
});

it('it renders successfully from route call', function () {
    actingAs($this->admin);

    get(route('admin'))->assertOk();
});

it('it redirects when the user is not admin', function () {
    seedSeller();

    $seller = User::whereType('seller')->first();

    actingAs($seller);

    get(route('admin'))
        ->assertRedirect();
});
