<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.guest')]
#[Title('Register | Dayz Shop')]
class Register extends Component
{
    #[Validate('required')]
    public string $name;

    #[Validate('required|email|unique:users,email')]
    public string $email;

    #[Validate('required')]
    public string $password;

    #[Validate('required_with:password|same:password')]
    public string $password_confirmation;

    public function register(): void
    {
        $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        dispatch(fn () => event(new Registered($user)))->afterResponse();

        $this->dispatch('flash-message', message: 'Succesfully registered. '.__('auth.verification-send'), title: 'Success!');

        $this->redirect('/', navigate: true);
    }

    public function render(): View
    {
        return view('livewire.auth.register');
    }
}
