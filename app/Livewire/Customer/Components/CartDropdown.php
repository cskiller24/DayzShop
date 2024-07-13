<?php

declare(strict_types=1);

namespace App\Livewire\Customer\Components;

use App\Models\Cart;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class CartDropdown extends Component
{
    public bool $show = false;

    #[On('cart-deleted')]
    public function showCartDropdown(): void
    {
        $this->show = true;
    }

    public function deleteCart($cartId): void
    {
        $cartId = Cart::findOr($cartId);

        $cartId->delete();

        $this->flashMessage('Cart deleted successfully');
        $this->dispatch('cart-deleted');
    }

    #[On('cart-added')]
    public function render(): View
    {
        $user = auth()->user();

        $user->load(['carts', 'carts.productVariant', 'carts.productVariant.product']);

        return view('livewire.customer.components.cart-dropdown', ['carts' => $user->carts]);
    }
}
