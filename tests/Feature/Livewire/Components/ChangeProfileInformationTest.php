<?php

declare(strict_types=1);

use App\Livewire\Components\ChangeUserInformation;
use App\Models\User;
use Livewire\Livewire;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    actAsCustomer();

    Livewire::test(ChangeUserInformation::class)
        ->assertStatus(200);
});
