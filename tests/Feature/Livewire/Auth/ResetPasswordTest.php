<?php

use App\Livewire\Auth\ResetPassword;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::withQueryParams(['email' => fake()->safeEmail()])
        ->test(ResetPassword::class, ['token' => fake()->text()])
        ->assertStatus(200);
});
