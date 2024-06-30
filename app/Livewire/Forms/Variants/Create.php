<?php

declare(strict_types=1);

namespace App\Livewire\Forms\Variants;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Form;
use Livewire\WithFileUploads;

class Create extends Form
{
    use WithFileUploads;

    #[Locked]
    public Product $product;

    #[Validate(['required'])]
    public ?string $name;

    #[Validate(['required'])]
    public ?string $description;

    #[Validate(['required', 'money'])]
    public ?string $price;

    #[Validate(['required', 'integer'])]
    public ?string $quantity;

    /**
     * @var TemporaryUploadedFile|null $photo
     */
    #[Validate(['nullable', 'image', 'max:1024'])]
    public $photo;

    public function setProduct(Product $product): static
    {
        $this->product = $product;

        return $this;
    }

    protected function castPriceToInt(): int
    {
        return str($this->price)
            ->replace(',', '')
            ->toInteger();
    }

    public function store(): void
    {
        $this->validate();

        DB::transaction(function () {
            $media = null;

            if ($this->photo) {
                $media = $this->product->addMedia($this->photo)->toMediaCollection();
            }
            $this->product->variants()->create([
                'name' => $this->name,
                'description' => $this->description,
                'price' => $this->castPriceToInt() * 100,
                'quantity' => $this->quantity,
                'media_id' => $media?->id ?? null,
            ]);
        });
    }
}
