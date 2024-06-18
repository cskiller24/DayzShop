<?php

declare(strict_types=1);

use App\Livewire\Seller\SelectStore;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(SelectStore::class)
        ->assertStatus(200);
});
