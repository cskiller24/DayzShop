<?php

declare(strict_types=1);

use App\Livewire\Seller\Components\Products\Variants\Table;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(Table::class)
        ->assertStatus(200);
});
