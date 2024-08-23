<?php

declare(strict_types=1);

use App\Livewire\Components\ChangeUserInformation;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(ChangeUserInformation::class)
        ->assertStatus(200);
});
