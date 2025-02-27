<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Enums\Type;
use App\Models\Address;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Settings extends Component
{
    public User $user;

    public function mount(): void
    {
        // @phpstan-ignore-next-line
        $this->user = auth()->user();
    }

    public function render(): View
    {
        return view('livewire.settings')
            ->layout($this->getLayout());
    }

    #[Computed]
    public function isEligibleForAddress(): bool
    {
        return $this->user->isSeller() || $this->user->isCustomer();
    }

    #[Computed]
    public function parseForAddressType(): string
    {
        return match ($this->user->type) {
            Type::SELLER => Address::STORE,
            Type::CUSTOMER => Address::USER,
            default => throw new \Exception('Invalid address parse type')
        };
    }

    public function getLayout(): string
    {
        return match (true) {
            $this->user->isAdmin() => 'components.layouts.roles.admin',
            $this->user->isSeller() => 'components.layouts.roles.seller',
            $this->user->isCustomer() => 'components.layouts.roles.customer',
            default => 'components.layouts.layout'
        };
    }
}
