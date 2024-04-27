<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Test')]
#[Layout('components.layouts.app')]
class Test extends Component
{
    public function render()
    {
        return view('livewire.test');
    }
}
