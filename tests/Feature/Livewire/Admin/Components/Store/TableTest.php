<?php

declare(strict_types=1);

use App\Livewire\Admin\Components\Store\Table;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Table::class)
        ->assertStatus(200);
});
