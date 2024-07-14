<?php

declare(strict_types=1);

namespace App\Livewire\Customer\Components;

use App\Models\Cart;
use Illuminate\View\View;
use Livewire\Component;

class CartCard extends Component
{
    public Cart $cart;

    public function mount(Cart $cart): void
    {
        $this->cart = $cart;
    }

    public function deleteCart(): void
    {
        $this->cart->delete();

        $this->flashMessage('Cart deleted successfully.');
    }

    public function increment(int $amount): void
    {
        $this->cart->increment('quantity', $amount);
    }

    public function decrement(int $amount): void
    {
        $this->cart->decrement('quantity', $amount);
    }

    public function render(): View
    {
        return view('livewire.customer.components.cart-card');
    }
}
