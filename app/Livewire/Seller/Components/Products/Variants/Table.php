<?php

declare(strict_types=1);

namespace App\Livewire\Seller\Components\Products\Variants;

use App\Livewire\Components\Toaster;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public Product $product;

    public function mount(Product $product): void
    {
        $this->product = $product;
    }

    public function delete(string $id): void
    {
        $productVariant = ProductVariant::query()->with('media')->findOrFail($id);

        DB::transaction(function () use ($productVariant): void {
            $productVariant->media?->delete();
            $productVariant->delete();
        });

        $this->dispatch('product-variant-deleted');

        $this->dispatch(Toaster::EVENT, message: 'Product variant has been deleted.');
    }

    public function render(): View
    {
        return view('livewire.seller.components.products.variants.table', [
            'variants' => $this->product->variants()->with('media')->paginate(),
        ]);
    }
}
