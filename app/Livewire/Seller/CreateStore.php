<?php

declare(strict_types=1);

namespace App\Livewire\Seller;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class CreateStore extends Component
{
    #[Validate(['required'])]
    public string $name;

    #[Validate(['required', 'email'])]
    public string $email;

    #[Validate(['sometimes', 'required'])]
    public string $description;

    #[Validate(['required'])]
    public string $phoneNumber;

    public function validateFields(): void
    {
        $this->validate();

        $this->dispatch('validated');
    }

    public function render(): View
    {
        return view('livewire.seller.create-store');
    }
}
