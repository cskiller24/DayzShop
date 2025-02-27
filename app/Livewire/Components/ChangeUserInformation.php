<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;

class ChangeUserInformation extends Component
{
    public string $email;

    public string $name;

    public function mount(): void
    {
        /** @var User $user */
        $user = auth()->user();

        $this->name = $user->name;
        $this->email = $user->email;
    }

    public function updateProfile(): void
    {
        /** @var User $user */
        $user = auth()->user();

        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ]);

        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        $this->dispatch(User::UPDATED);

        $this->flashMessage('Updated user profile successfully');
    }

    public function render(): View
    {
        return view('livewire.components.change-user-information');
    }
}
