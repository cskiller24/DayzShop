<?php

declare(strict_types=1);

use App\Livewire\Customer\Components\ProductCard;
use Livewire\Livewire;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(ProductCard::class)
        ->assertStatus(200);
});
