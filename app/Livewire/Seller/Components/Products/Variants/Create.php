<?php

declare(strict_types=1);

namespace App\Livewire\Seller\Components\Products\Variants;

use App\Livewire\Components\Toaster;
use App\Livewire\Forms\Variants\Create as CreateForm;
use App\Models\Product;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public Product $product;

    public CreateForm $form;

    public string $modalId;

    public function mount(Product $product, string $modalId = 'product-add-variant'): void
    {
        $this->product = $product;
        $this->modalId = $modalId;
    }

    public function store(): void
    {
        $this->authorize('create', Product::class);

        $this->form->setProduct($this->product)->store();
        $this->form->reset(['name', 'description', 'price', 'photo', 'quantity']);

        $this->dispatch(Toaster::EVENT, message: 'Successfully added product variant');

        $this->dispatch('product-variant-added');

        $this->closeModal($this->modalId);
    }

    public function render(): View
    {
        return view('livewire.seller.components.products.variants.create');
    }
}
