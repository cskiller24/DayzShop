<?php

declare(strict_types=1);

use App\Livewire\Auth\UseInvitation;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(UseInvitation::class)
        ->assertStatus(200);
});
