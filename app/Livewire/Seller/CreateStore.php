<?php

declare(strict_types=1);

namespace App\Livewire\Seller;

use App\Actions\EnsureSellerDoesHaveAnyStore;
use App\Models\Store;
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

    public function mount(): void
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if($user->stores()->count() > 0) {
            $this->redirect(route('seller'), navigate: true);
        }
    }

    public function validateFields(): void
    {
        $this->validate();

        $this->dispatch('validated');
    }

    public function render()
    {
        return view('livewire.seller.create-store');
    }
}
