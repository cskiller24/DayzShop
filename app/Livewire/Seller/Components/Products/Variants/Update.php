<?php

declare(strict_types=1);

namespace App\Livewire\Seller\Components\Products\Variants;

use App\Livewire\Components\Toaster;
use App\Livewire\Forms\Variants\Update as UpdateForm;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;

    public UpdateForm $form;

    public string $modalId;

    public function mount(Product $product, string $modalId = 'product-variant-update-form'): void
    {
        $this->form->setProduct($product);
        $this->modalId = $modalId;
    }

    #[On('variant-edit')]
    public function setVariantAndOpen(ProductVariant $variant): void
    {
        abort_if($variant->product_id !== $this->form->product->id, 404);

        $this->form->setVariant($variant);

        $this->openModal($this->modalId);
    }

    public function update(): void
    {
        $this->form->update();

        $this->dispatch(Toaster::EVENT, message: 'Successfully updated product variant');

        $this->dispatch('product-variant-update');

        $this->closeModal($this->modalId);
    }

    public function render(): View
    {
        return view('livewire.seller.components.products.variants.update');
    }
}
