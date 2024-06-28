<?php

declare(strict_types=1);

namespace App\Livewire\Seller\Components\Products;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    use WithPagination;

    public function delete(string $id): void
    {
        DB::transaction(function () use ($id): void {
            $product = Product::query()->findOrFail($id);
            $product->categories()->sync([], true);
            $product->variants()->delete();
            $product->delete();

            $this->dispatch(
                'flash-message',
                message: 'Successfully deleted product.',
            );
        });
    }

    public function render(): View
    {
        return view('livewire.seller.components.products.table', [
            'products' => Product::query()->paginate(),
        ]);
    }
}
