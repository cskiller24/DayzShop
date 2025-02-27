<?php

declare(strict_types=1);

use App\Livewire\Settings\Address\Edit;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(Edit::class)
        ->assertStatus(200);
});
