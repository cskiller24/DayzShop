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
        $status = Password::sendResetLink(
            ['email' => $this->email],
        );

        if(Password::RESET_LINK_SENT !== $status) {
            $this->addError('email', $status);
        }

        toast('Successfully resend password, please check your email.');

        return $this->redirect(route('login'), true);
    }

    public function render(): View
    {
        return view('livewire.auth.forgot-password');
    }
}
