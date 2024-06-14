<?php

use App\Livewire\Admin\Components\Invites\Table;
use Livewire\Livewire;

it('renders successfully', function () {
    Livewire::test(Table::class)
        ->assertStatus(200);
});
