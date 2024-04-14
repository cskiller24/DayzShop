<?php

use App\Livewire\Auth\ResetPassword;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(ResetPassword::class)
        ->assertStatus(200);
});
