<?php

declare(strict_types=1);

namespace App\Livewire\Auth;

use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('components.layouts.guest')]
#[Title('Email Verify | Dayz Shop')]
class EmailVerification extends Component
{
    public function render(): View
    {
        return view('livewire.auth.email-verification');
    }
}
