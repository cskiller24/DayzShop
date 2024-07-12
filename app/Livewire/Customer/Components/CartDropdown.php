<?php

declare(strict_types=1);

namespace App\Livewire\Customer\Components;

use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CartDropdown extends Component
{
    #[On('cart-added')]
    public function render(): View
    {
        $user = auth()->user();

        $user->load(['carts', 'carts.productVariant']);

        return view('livewire.customer.components.cart-dropdown', ['carts' => $user->carts]);
    }
}
