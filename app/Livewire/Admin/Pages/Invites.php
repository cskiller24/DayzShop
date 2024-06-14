<?php

namespace App\Livewire\Admin\Pages;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.roles.admin')]
class Invites extends Component
{
    public function render()
    {
        return view('livewire.admin.pages.invites');
    }
}
