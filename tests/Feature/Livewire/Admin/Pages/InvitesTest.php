<?php

use App\Livewire\Admin\Pages\Invites;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Invites::class)
        ->assertStatus(200);
});
