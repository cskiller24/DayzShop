<?php

declare(strict_types=1);

namespace App\Livewire\Seller;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class SelectStore extends Component
{
    public User $user;

    public function mount(): void
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if ($user?->active_store_id !== null) {
            $this->redirect(route('seller'), navigate: true);
        }

        $this->user = $user;
    }

    public function render(): View
    {
        return view('livewire.seller.select-store', [
            'stores' => auth()->user()?->stores,
        ]);
    }
}
