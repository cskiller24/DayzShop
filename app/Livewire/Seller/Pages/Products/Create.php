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

    public array $specifications;

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
        dd($this->specifications);
    }

    public function render(): View
    {
        return view('livewire.seller.pages.products.create');
    }
}
