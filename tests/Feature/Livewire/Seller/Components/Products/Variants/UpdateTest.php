<?php

declare(strict_types=1);

use App\Livewire\Seller\Components\Products\Variants\Update;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Update::class)
        ->assertStatus(200);
});
