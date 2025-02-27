<?php

declare(strict_types=1);

use App\Livewire\Settings\Address\Create;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(Create::class)
        ->assertStatus(200);
});
