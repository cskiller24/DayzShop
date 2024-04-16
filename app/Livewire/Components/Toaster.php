<?php

namespace App\Livewire\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class Toaster extends Component
{
    #[On('flash-message')]
    public function flashToast(string $message = null, string $title = null, $type = \Flasher\Prime\Notification\NotificationInterface::SUCCESS, $options = [])
    {
        toast($message, $title, $type, $options);
    }

    public function render()
    {
        return view('livewire.components.toaster');
    }
}
