<?php

use App\Livewire\Admin\Pages\Invites;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {

    actingAs(User::factory()->admin()->create());

    Livewire::test(Invites::class)
        ->assertStatus(200);
});
