<?php

declare(strict_types=1);

namespace App\Livewire\Seller\Pages\Products;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.roles.seller')]
class Create extends Component
{
    public string $name;

    public string $description;

    public array $specification = [];

    public function create(): void
    {
        dd($this->specification);
    }

    public function render(): View
    {
        return view('livewire.seller.pages.products.create');
    }
}
