<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Pages\Store;

use App\Enums\Type;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.roles.admin')]
class Create extends Component
{
    #[Validate(['required'])]
    public string $name;

    #[Validate(['required', 'email'])]
    public string $email;

    #[Validate(['sometimes', 'required'])]
    public string $description;

    #[Validate(['required'])]
    public string $phoneNumber;

    #[Validate(['nullable', 'exists:users,id'])]
    public array $sellers;

    public function create()
    {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.admin.pages.store.create', [
            'availableSellers' => User::query()
                ->where('type', Type::SELLER->value)
                ->get()
        ]);
    }
}
