<?php

use App\Livewire\Auth\ForgotPassword;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(ForgotPassword::class)
        ->assertStatus(200);
});
