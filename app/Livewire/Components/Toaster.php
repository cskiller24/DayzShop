<?php

namespace App\Livewire\Components;

use Flasher\Prime\Notification\NotificationInterface;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Toaster extends Component
{
    #[On('flash-message')]
    /**
     * @param array<int, mixed> $options
     */
    public function flashToast(
        ?string $message = null,
        ?string $title = null,
        NotificationInterface|string $type = NotificationInterface::SUCCESS,
        array $options = []
    ): void {
        toast($message, $title, $type, $options);
    }

    public function render(): View
    {
        return view('livewire.components.toaster');
    }
}
