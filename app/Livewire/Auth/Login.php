<?php

namespace App\Livewire\Auth;

use App\Models\User;
use App\Notifications\TestNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
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

    public function login()
    {
        $this->validate();
        if(! Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $this->addError('email', 'Credentials provided does not match.');
        }

        Auth::login(User::where('email', $this->email)->first());

        return $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
