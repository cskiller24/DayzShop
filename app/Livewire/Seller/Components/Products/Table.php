<?php

declare(strict_types=1);

namespace App\Livewire\Seller\Components\Products;

use App\Models\Product;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public function render(): View
    {
        return view('livewire.seller.components.products.table', [
            'products' => Product::query()->paginate(),
        ]);
    }
}
