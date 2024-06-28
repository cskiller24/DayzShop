<?php

declare(strict_types=1);

use App\Livewire\Components\Alert;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Alert::class)
        ->assertStatus(200);
});
