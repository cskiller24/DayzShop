<?php

namespace App\Livewire\Admin\Components\Invitations;

use Livewire\Component;

class Create extends Component
{
    public string $modalId;

    public function mount(string $modalId): void
    {
        $this->modalId = $modalId;
    }
    public function render()
    {
        return view('livewire.admin.components.invitations.create');
    }
}
