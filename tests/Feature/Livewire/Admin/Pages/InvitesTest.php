<?php

use App\Livewire\Admin\Pages\Invites;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {

    Livewire::actingAs(seedAdmin())
        ->test(Invites::class)
        ->assertStatus(200);
});
