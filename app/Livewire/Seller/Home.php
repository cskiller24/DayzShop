<?php

declare(strict_types=1);

namespace App\Livewire\Seller;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.roles.seller')]
class Home extends Component
{
    public function render(): View
    {
        return view('livewire.seller.home');
    }
}
