<?php

declare(strict_types=1);

namespace App\Livewire\Customer\Pages\Products;

use App\Models\Cart;
use App\Models\Product;
use Flasher\Prime\Notification\NotificationInterface;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.roles.customer')]
class Show extends Component
{
    public Product $product;

    public ?string $productVariantId = null;

    public function mount(Product $product): void
    {
        $this->product = $product;

        $this->product->load(['store', 'variants', 'media', 'categories']);
    }

    public function addToCart(): void
    {
        $user = auth()->user();

        if($user === null) {
            $this->flashMessage('Please login first', 'Error!', NotificationInterface::ERROR);
            return;
        }

        if($this->productVariantId === null) {
            $this->flashMessage('Please specify a product variant', 'Error!', NotificationInterface::ERROR);
            return;
        }

        $cart = Cart::query()
            ->where('user_id', $user->id)
            ->where('product_variant_id', $this->productVariantId)
            ->first();

        if($cart === null) {
            Cart::query()->create([
                'user_id' => $user->id,
                'product_variant_id' => $this->productVariantId,
                'quantity' => 1
            ]);

            $this->flashMessage('Added to cart');
            return;
        }

        $cart->increment('quantity');

        $this->flashMessage('Added to cart');
        
        $this->dispatch('cart-added');
    }

    public function render(): View
    {
        return view('livewire.customer.pages.products.show');
    }
}
