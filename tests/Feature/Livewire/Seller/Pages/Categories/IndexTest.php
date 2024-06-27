<?php

declare(strict_types=1);

use App\Livewire\Seller\Pages\Categories\Index;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Index::class)
        ->assertStatus(200);
});
