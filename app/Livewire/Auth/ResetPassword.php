<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.guest')]
#[Title('Password Reset | DayzShop')]
class ResetPassword extends Component
{
    #[Rule('required')]
    public string $token;

    #[Url]
    #[Rule('required|email')]
    public string $email;

    #[Validate('required')]
    public string $password;

    #[Validate('required_with:password|same:password')]
    public string $password_confirmation;

    public function mount($token)
    {
        $this->token = $token;
    }

    public function passwordReset()
    {
        $this->validate();

        $status = Password::reset([
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'token' => $this->token,
        ], function (User $user, string $password) {
            $user->forceFill([
                'password' => bcrypt($password),
            ]);

            $user->save();
        });

        toast(__($status));

        return $this->redirect(route('login'), true);
    }

    public function render()
    {
        return view('livewire.auth.reset-password');
    }
}
