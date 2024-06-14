<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.roles.admin')]
class Home extends Component
{
    public function render(): View
    {
        return view('livewire.admin.home');
    }
}
