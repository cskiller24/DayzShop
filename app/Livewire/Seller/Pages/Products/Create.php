<?php

declare(strict_types=1);

namespace App\Livewire\Seller\Pages\Products;

use App\Concerns\ValidatesInAlert;
use App\Livewire\Components\Toaster;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.roles.seller')]
class Create extends Component
{
    use ValidatesInAlert;

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

    public function mount(): void
    {
        $this->addSpecification();
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

    public function create(): void
    {
        $this->authorize('create', Product::class);
        $this->validate();
        $this->setAlertValidation();

        $specifications = collect($this->specifications)->mapWithKeys(fn (array $specification) => [$specification['key'] => $specification['value']])->toArray();

        $product = Product::query()->create([
            'name' => $this->name,
            'description' => $this->description,
            'specifications' => $specifications,
        ]);

        $product->categories()->sync($this->categories);

        $this->dispatch(Toaster::EVENT, message: 'Product created successfully');

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
        return view('livewire.seller.pages.products.create', [
            'categoriesOptions' => Category::all(),
        ]);
    }
}
