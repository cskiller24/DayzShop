<?php

declare(strict_types=1);

use App\Livewire\Seller\CreateStore;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(CreateStore::class)
        ->assertStatus(200);
});
