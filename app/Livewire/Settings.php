<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Settings extends Component
{
    protected User $user;

    public function mount(): void
    {
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
