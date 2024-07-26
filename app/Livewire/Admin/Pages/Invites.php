<?php

declare(strict_types=1);

namespace App\Livewire\Admin\Pages;

use App\Models\Invite;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.roles.admin')]
class Invites extends Component
{
    public function mount(): void
    {
        $this->authorize('viewAny', Invite::class);
    }

    public function render(): View
    {
        return view('livewire.admin.pages.invites');
    }
}
