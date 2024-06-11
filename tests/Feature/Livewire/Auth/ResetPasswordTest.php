<?php

declare(strict_types=1);

use App\Livewire\Auth\ResetPassword;
use Livewire\Livewire;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::withQueryParams(['email' => fake()->safeEmail()])
        ->test(ResetPassword::class, ['token' => fake()->text()])
        ->assertStatus(200);
});
