<?php

declare(strict_types=1);

use App\Livewire\Customer\Components\CartDropdown;
use Livewire\Livewire;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(CartDropdown::class)
        ->assertStatus(200);
});
