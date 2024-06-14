<?php

declare(strict_types=1);

namespace App\Livewire\Courier;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.roles.courier')]
class Home extends Component
{
    public function render(): View
    {
        return view('livewire.courier.home');
    }
}
