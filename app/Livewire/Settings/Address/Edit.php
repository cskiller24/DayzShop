<?php

declare(strict_types=1);

namespace App\Livewire\Settings\Address;

use Illuminate\View\View;
use Livewire\Component;

class Edit extends Component
{
    public function render(): View
    {
        return view('livewire.settings.address.edit');
    }
}
