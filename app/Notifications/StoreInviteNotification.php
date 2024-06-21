<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\Store;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StoreInviteNotification extends Notification
{
    use Queueable;

    public function __construct(public Store $store)
    {
    }

    /**
     * @return array<int, string>
     */
    public function via(): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(): MailMessage
    {
        return (new MailMessage())
            ->line("Welcome, you are in invite in {$this->store->name} store.")
            ->action('Click here to accept the invitation', url('/'))
            ->line('Thank you for using our application!');
    }
}
