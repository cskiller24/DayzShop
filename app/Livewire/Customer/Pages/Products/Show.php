<?php

declare(strict_types=1);

namespace App\Livewire\Customer\Pages\Products;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Flasher\Prime\Notification\NotificationInterface;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.roles.customer')]
class Show extends Component
{
    public Product $product;

    public int $quantity = 1;

    public ?string $productVariantId = null;

    public function mount(Product $product): void
    {
        $this->product = $product;

        $this->product->load(['store', 'variants', 'media', 'categories']);
    }

    public function addToCart(): void
    {
        if($this->validateCart()) {
            return;
        };

        /** @var User $user */
        $user = auth()->user();

        $cart = Cart::query()
            ->where('user_id', $user->id)
            ->where('product_variant_id', $this->productVariantId)
            ->first();

        if($cart === null) {
            $cart = Cart::query()->create([
                'user_id' => $user->id,
                'product_variant_id' => $this->productVariantId,
                'quantity' => 0,
            ]);
        }

        $cart->update(['quantity' => $cart->quantity += $this->quantity]);
        $this->quantity = 1;

        $this->flashMessage('Added to cart');
        $this->dispatch('cart-added');
    }

    public function validateCart(): bool
    {
        if($this->productVariantId === null) {
            $this->flashMessage('Please specify a product variant', 'Error!', NotificationInterface::ERROR);
            return true;
        }

        if(auth()->user() === null) {
            $this->flashMessage('Please login first', 'Error!', NotificationInterface::ERROR);
            return true;
        }

        return false;
    }

    public function render(): View
    {
        return view('livewire.customer.pages.products.show');
    }
}
