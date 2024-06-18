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

    public function wtf(): void
    {
        $this->validate();

        $store = Store::query()->create([
            'name' => $this->name,
            'email' => $this->email,
            'description' => $this->description,
            'phone_number' => $this->phoneNumber,
        ]);

        /**
         * @var \App\Models\User $user
         */
        $user = auth()->user();

        $user->setAsActive($store);

        $this->redirectToRole();
    }

    public function render()
    {
        return view('livewire.seller.create-store');
    }
}
