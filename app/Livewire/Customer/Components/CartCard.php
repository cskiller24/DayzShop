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

    public function increment(int $amount = 1): void
    {
        $this->cart->increment('quantity', $amount);
    }

    public function decrement(int $amount = 1): void
    {
        $this->cart->decrement('quantity', $amount);

        if($this->cart->quantity === 0) {
            $this->js("$parent.deleteCart('{$this->cart->id}')");
        }
    }

    public function render(): View
    {
        return view('livewire.customer.components.cart-card');
    }
}
