<?php

declare(strict_types=1);

namespace App\Livewire\Customer\Pages\Products;

use App\Models\Product;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.roles.customer')]
class Show extends Component
{
    public Product $product;

    public function mount(Product $product): void
    {
        $this->product = $product;

        $this->product->load(['store', 'variants', 'media', 'categories']);
    }

    public function render(): View
    {
        return view('livewire.customer.pages.products.show');
    }
}
