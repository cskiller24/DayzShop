<?php

declare(strict_types=1);

namespace App\Livewire\Customer;

use Illuminate\View\View;
use Livewire\Component;

class Home extends Component
{
    public function render(): View
    {
        return view('livewire.customer.home');
    }
}
