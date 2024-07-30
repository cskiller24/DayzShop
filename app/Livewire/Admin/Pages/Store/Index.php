<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Pages\Store;

use App\Models\Store;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.roles.admin')]
class Index extends Component
{
    public function mount(): void
    {
        $this->authorize('viewAny', Store::class);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.store.index');
    }
}
