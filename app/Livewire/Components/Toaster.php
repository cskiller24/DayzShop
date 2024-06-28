<?php

declare(strict_types=1);

namespace App\Livewire\Components;

use Flasher\Prime\Notification\NotificationInterface;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Toaster extends Component
{
    public const string EVENT = 'flash-message';

    #[On(self::EVENT)]
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
