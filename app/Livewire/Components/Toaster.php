<?php

namespace App\Livewire\Components;

use Flasher\Prime\Notification\NotificationInterface;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Toaster extends Component
{
    #[On('flash-message')]
    public function flashToast(
        ?string $message = null,
        ?string $title = null,
        NotificationInterface|string $type = NotificationInterface::SUCCESS,
    ): void {
        toast($message, $title, $type);
    }

    public function render(): View
    {
        return view('livewire.components.toaster');
    }
}
