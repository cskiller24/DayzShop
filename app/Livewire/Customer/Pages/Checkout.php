<?php

declare(strict_types=1);

namespace App\Livewire\Customer\Pages;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.roles.customer')]
class Checkout extends Component
{
    public function render(): View
    {
        return view('livewire.customer.pages.checkout');
    }
}
