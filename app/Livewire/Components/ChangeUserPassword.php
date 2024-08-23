<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ChangeUserPassword extends Component
{
    #[Validate('required|current_password:web')]
    public string $oldPassword;

    #[Validate('required')]
    public string $newPassword;

    #[Validate('required_with:newPassword|same:newPassword')]
    public string $confirmNewPassword;

    public function changePassword(): void
    {
        $this->validate();

        /** @var User $user */
        $user = auth()->user();

        $user->forceFill([
            'password' => Hash::make($this->newPassword),
        ])->save();

        $this->reset();

        $this->flashMessage('Updated password successfully!');
    }

    public function render(): View
    {
        return view('livewire.components.change-user-password');
    }
}
