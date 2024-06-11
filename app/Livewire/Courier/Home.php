<?php

namespace App\Livewire\Courier;

use Illuminate\View\View;
use Livewire\Component;

class Home extends Component
{
    public function render(): View
    {
        return view('livewire.courier.home');
    }
}