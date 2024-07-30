<?php

declare(strict_types=1);

use App\Livewire\Admin\Pages\Store\Index;
use Livewire\Livewire;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::actingAs(seedAdmin())
        ->test(Index::class)
        ->assertStatus(200);
});
