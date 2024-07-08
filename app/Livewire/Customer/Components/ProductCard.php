<?php

declare(strict_types=1);

namespace App\Livewire\Customer\Components;

use App\Models\Product;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ProductCard extends Component
{
    public Product $product;

    public function mount(Product $product): void
    {
        $this->product = $product;
    }

    #[Computed]
    public function highestPrice(): string
    {
        return $this->product->highestVariantPrice()->format();
    }

    #[Computed]
    public function lowestPrice(): string
    {
        return $this->product->lowestVariantPrice()->format();
    }

    public function render(): View
    {
        return view('livewire.customer.components.product-card');
    }
}
