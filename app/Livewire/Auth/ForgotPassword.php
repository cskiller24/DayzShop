<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.guest')]
#[Title('Forgot Password | Dayz Shop')]
class ForgotPassword extends Component
{
    #[Validate('required|email|exists:users,email')]
    public string $email;

    public function sendPasswordReset()
    {
        $this->validate();

        $status = Password::sendResetLink(
            ['email' => $this->email],
        );

        if ($status !== Password::RESET_LINK_SENT) {
            $this->addError('email', $status);
        }

        $this->dispatch('flash-message', message: __($status));

        return $this->redirect(route('login'), true);
    }

    public function render(): View
    {
        return view('livewire.auth.forgot-password');
    }
}
