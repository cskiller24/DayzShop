<?php

declare(strict_types=1);

use App\Livewire\Customer\Pages\Checkout;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(Checkout::class)
        ->assertStatus(200);
});
