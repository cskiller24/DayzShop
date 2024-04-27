<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Welcome | DayzShop')]
#[Layout('components.layouts.app')]
class Welcome extends Component
{
    public function render()
    {
        return view('livewire.welcome');
    }
}
