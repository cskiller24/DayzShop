<?php

declare(strict_types=1);

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Welcome | DayzShop')]
#[Layout('components.layouts.base')]
class Welcome extends Component
{
    public function render(): View
    {
        return view('livewire.welcome');
    }
}
