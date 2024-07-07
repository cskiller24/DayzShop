<?php

declare(strict_types=1);

namespace App\Livewire\Customer\Components;

use Illuminate\View\View;
use Livewire\Component;

class ProductCard extends Component
{
    public function render(): View
    {
        return view('livewire.customer.components.product-card');
    }
}
