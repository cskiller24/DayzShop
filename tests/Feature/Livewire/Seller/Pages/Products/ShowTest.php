<?php

declare(strict_types=1);

use App\Livewire\Seller\Pages\Products\Show;
use App\Models\Product;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Show::class, ['product' => Product::factory()->createQuietly()])
        ->assertStatus(200);
});
