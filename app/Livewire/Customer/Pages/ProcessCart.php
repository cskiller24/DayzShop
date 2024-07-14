<?php

declare(strict_types=1);

namespace App\Livewire\Customer\Pages;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.roles.customer')]
class ProcessCart extends Component
{
    public User $user;

    public function mount(): void
    {
        $this->user = auth()->user();
    }

    public function render(): View
    {
        $carts = $this->user
            ->carts()
            ->with([
                'productVariant',
                'productVariant.product'
            ])->get();

        return view('livewire.customer.pages.process-cart', compact('carts'));
    }
}
