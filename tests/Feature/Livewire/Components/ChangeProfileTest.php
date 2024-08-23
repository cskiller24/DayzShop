<?php

declare(strict_types=1);

use App\Livewire\Components\ChangeProfile;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

it('renders successfully', function () {
    Livewire::test(ChangeProfile::class)
        ->assertStatus(200);
});
