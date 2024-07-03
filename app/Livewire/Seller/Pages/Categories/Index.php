<?php

declare(strict_types=1);

namespace App\Livewire\Seller\Pages\Categories;

use App\Models\Category;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.roles.seller')]
class Index extends Component
{
    #[Validate('required')]
    public string $name;

    public function create(): void
    {
        $this->validate();

        Category::create(['name' => $this->name]);

        $this->dispatch('flash-message', message: 'Category created successfully');

        $this->dispatch('category-created');
    }

    public function render(): View
    {
        return view('livewire.seller.pages.categories.index');
    }
}
