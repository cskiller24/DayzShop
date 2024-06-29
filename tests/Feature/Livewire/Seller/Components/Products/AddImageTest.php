<?php

declare(strict_types=1);

use App\Livewire\Seller\Components\Products\AddImage;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(AddImage::class)
        ->assertStatus(200);
});
