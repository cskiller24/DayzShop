<?php

use Flasher\Prime\Notification\Envelope;
use Flasher\Prime\Notification\NotificationInterface;

if (! function_exists('toast')) {
    /**
     * @param  string  $type
     * @param  array<string, mixed>  $options
     */
    function toast(?string $message = null, ?string $title = null, NotificationInterface|string $type = NotificationInterface::SUCCESS, array $options = []): Envelope
    {
        return pnotify()->timer(2000)->addFlash(type: $type, message: $message, title: $title, options: $options);
    }

}
