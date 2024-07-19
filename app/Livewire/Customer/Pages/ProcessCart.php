<?php

declare(strict_types=1);

namespace App\Livewire\Customer\Pages;

use App\Models\Cart;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.roles.customer')]
class ProcessCart extends Component
{
    public User $user;

    public int|float $cartTotal;

    public function mount(): void
    {
        $this->user = auth()->user();
    }

    public function deleteCart(Cart|string $cart): void
    {
        $this->getCart($cart)->delete();
    }

    protected function getCart(Cart|string $cart): Cart
    {
        if(is_string($cart)) {
            return Cart::query()->findOrFail($cart);
        }

        return $cart;
    }

    public function render(): View
    {
        $carts = $this->user
            ->carts()
            ->with([
                'productVariant',
                'productVariant.product'
            ])->get();

        $total = 0;

        foreach ($carts as $cart) {
            $total += ($cart->productVariant->price->multiply($cart->quantity)->getAmount()) / 100;
        }

        return view('livewire.customer.pages.process-cart', compact('carts', 'total'));
    }
}
