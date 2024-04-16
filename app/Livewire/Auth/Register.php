<?php

namespace App\Livewire\Auth;

use App\Models\User;
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

    public function register()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);

        $this->dispatch('flash-message', message: 'Succesfully registered.', title: 'Success!');

        return $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
