<?php

declare(strict_types=1);

namespace App\Livewire\Seller\Pages\Products;

use App\Concerns\ValidatesInAlert;
use App\Livewire\Components\Toaster;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;

#[Layout('components.layouts.roles.seller')]
class Edit extends Component
{
    use ValidatesInAlert;

    #[Locked]
    public Product $product;

    public string $name;

    public string $description;

    /**
     * @var array<int, array<string, string>>
     */
    public array $specifications;

    /**
     * @var array<int, string>
     */
    public array $categories;

    /**
     * @return array<string, string|array<int, string>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'specifications' => ['required', 'array'],
            'categories' => ['required', 'array'],
        ];
    }

    public function mount(Product $product): void
    {
        $this->addSpecification();

        $product->load('categories');

        $specifications = array_map(fn (string $key, string $value): array => [
            'key' => $key,
            'value' => $value,
        ], $product->specifications, array_keys($product->specifications)); // @phpstan-ignore-line

        $this->fill([
            'name' => $product->name,
            'description' => $product->description,
            'specifications' => $specifications,
            'categories' => $product->categories->pluck('id')->toArray(),
        ]);
    }

    public function addSpecification(): void
    {
        $this->specifications[] = [
            'key' => '',
            'value' => '',
        ];
    }

    public function removeSpecification(string $id): void
    {
        if (count($this->specifications) < 1) {
            return;
        }
        foreach ($this->specifications as $key => $specification) {
            if ($key == $id) {
                unset($this->specifications[$key]);
                break;
            }
        }

        $this->specifications = array_values($this->specifications);
    }

    public function update(): void
    {
        $this->authorize('update', Product::class);
        $this->validate();
        $this->setAlertValidation();

        $specifications = collect($this->specifications)
            ->mapWithKeys(fn (array $specification) => [$specification['key'] => $specification['value']])
            ->toArray();

        DB::transaction(function () use ($specifications): void {
            $this->product->update([
                'name' => $this->name,
                'description' => $this->description,
                'specifications' => $specifications,
            ]);

            $this->product->categories()->sync($this->categories);
        });

        $this->dispatch(Toaster::EVENT, message: 'Product updated successfully');

        $this->redirect(route('seller.products.index'), true);
    }

    /**
     * @return array<string, mixed>
     */
    private function setAlertValidation(): array
    {
        return $this->validateOnAlert([
            'specifications' => $this->specifications,
            'categories' => $this->categories,
        ], [
            'specifications' => ['required', 'array'],
            'specifications.*.key' => ['required'],
            'specifications.*.value' => ['required'],
            'categories' => ['required', 'array'],
            'categories.*' => ['required', 'exists:categories,id'],
        ], [
            'specifications.*.key.required' => 'One of the specifications key is not filled',
            'specifications.*.value.required' => 'One of the specifications value is not filled',
            'categories.*.exists' => 'Invalid categories.',
        ]);
    }

    public function render(): View
    {
        return view('livewire.seller.pages.products.edit', [
            'categoriesOptions' => Category::all(),
        ]);
    }
}
