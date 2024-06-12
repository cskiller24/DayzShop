<?php

declare(strict_types=1);

use App\Livewire\Admin\Pages\Invitation;
use Livewire\Livewire;

use function Pest\Laravel\withoutVite;

beforeEach(function () {
    withoutVite();
});

test('it renders successfully', function () {
    Livewire::test(Invitation::class)
        ->assertStatus(200);
});
