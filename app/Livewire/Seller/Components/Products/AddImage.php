<?php

declare(strict_types=1);

namespace App\Livewire\Seller\Components\Products;

use App\Livewire\Components\Toaster;
use App\Models\Product;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AddImage extends Component
{
    use WithFileUploads;

    #[Locked]
    public Product $product;

    /**
     * @var TemporaryUploadedFile|UploadedFile|null $photo
     */
    #[Validate(['required', 'image', 'max:1024'])]
    public $photo;

    public string $modalId;

    public function mount(Product $product, string $modalId = 'product-add-image'): void
    {
        $this->product = $product;
        $this->modalId = $modalId;
    }

    public function addImage(): void
    {
        $this->authorize('create', Product::class);

        $this->validate();

        $this->product->addMedia($this->photo)->toMediaCollection(); // @phpstan-ignore-line

        $this->dispatch(Toaster::EVENT, message: 'Added image successfully');
        $this->dispatch('product-image-added');
        $this->closeModal($this->modalId);

        $this->reset(['photo']);
    }

    public function render(): View
    {
        return view('livewire.seller.components.products.add-image');
    }
}
