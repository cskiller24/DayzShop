<?php

declare(strict_types=1);

use App\Livewire\Seller\Pages\Products\Index;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::actingAs(seedSeller())
        ->test(Index::class)
        ->assertStatus(200);
});
