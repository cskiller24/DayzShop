<?php

declare(strict_types=1);

namespace App\Livewire\Seller\Components\Products;

use App\Livewire\Components\Toaster;
use App\Models\Product;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;

class Table extends Component
{
    use WithPagination;

    /**
     * @throws AuthorizationException
     * @throws Throwable
     */
    public function delete(string $id): void
    {
        $this->authorize('delete', Product::class);

        DB::transaction(function () use ($id): void {
            $product = Product::query()->findOrFail($id);
            $product->categories()->sync([], true);
            $product->variants()->delete();
            $product->delete();
        });
        $this->dispatch(
            Toaster::EVENT,
            message: 'Successfully deleted product.',
        );
    }

    public function render(): View
    {
        return view('livewire.seller.components.products.table', [
            'products' => Product::query()->paginate(),
        ]);
    }
}
