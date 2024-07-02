<?php

declare(strict_types=1);

use App\Livewire\Seller\Pages\Products\Edit;
use App\Models\Product;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Edit::class, ['product' => Product::factory()->createQuietly()])
        ->assertStatus(200);
});
