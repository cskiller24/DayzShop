<?php

use Flasher\Prime\Notification\NotificationInterface;

if (! function_exists('toast')) {
    /**
     * @param  string  $message
     * @param  string  $type
     * @param  array<string, mixed>  $options
     */
    function toast($message = null, $title = null, NotificationInterface|string $type = NotificationInterface::SUCCESS, array $options = [])
    {
        return pnotify()->timer(2000)->addFlash(type: $type, message: $message, title: $title, options: $options);
    }

}
