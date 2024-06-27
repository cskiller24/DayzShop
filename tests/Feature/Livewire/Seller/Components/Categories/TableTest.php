<?php

declare(strict_types=1);

use App\Livewire\Seller\Components\Categories\Table;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Table::class)
        ->assertStatus(200);
});
