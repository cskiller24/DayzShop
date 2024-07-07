<?php

declare(strict_types=1);

use App\Livewire\Customer\Pages\Shop;
use Livewire\Livewire;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(Shop::class)
        ->assertStatus(200);
});
