<?php

declare(strict_types=1);

namespace App\Livewire\Seller\Pages\Products;

use App\Models\Product;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.roles.seller')]
class Index extends Component
{
    public function mount(): void
    {
        $this->authorize('viewAny', Product::class);
    }

    public function render(): View
    {
        return view('livewire.seller.pages.products.index');
    }
}
