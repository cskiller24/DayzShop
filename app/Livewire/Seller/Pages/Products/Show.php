<?php

declare(strict_types=1);

namespace App\Livewire\Seller\Pages\Products;

use App\Models\Product;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.roles.seller')]
class Show extends Component
{
    public Product $product;

    public function mount(Product $product): void
    {
        $this->product = $product;
    }

    public function render(): View
    {
        return view('livewire.seller.pages.products.show');
    }
}
