<?php

declare(strict_types=1);

namespace App\Livewire\Seller;

use Illuminate\View\View;
use Livewire\Component;

class SelectStore extends Component
{
    public function mount(): void
    {
        /** @var \App\Models\User $user */
        $user = auth()->user();

        if($user->active_store_id !== null) {
            $this->redirect(route('seller'), navigate: true);
        }
    }

    public function render(): View
    {
        return view('livewire.seller.select-store', [
            'stores' => auth()->user()->stores,
        ]);
    }
}
