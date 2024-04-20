<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.guest')]
#[Title('Login | Dayz Shop')]
class Login extends Component
{
    #[Validate('required|email|exists:users,email')]
    public string $email;

    #[Validate('required')]
    public string $password = '';

    public function login(): void
    {
        $this->validate();
        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $this->addError('email', 'Credentials provided does not match.');

            return;
        }

        $this->redirect('/', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.auth.login');
    }
}
