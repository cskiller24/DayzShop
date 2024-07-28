<?php

declare(strict_types=1);

use Flasher\Prime\Notification\Envelope;
use Flasher\Prime\Notification\NotificationInterface;

if (! function_exists('toast')) {
    /**
     * @param  string  $type
     * @param  array<mixed>  $options
     */
    function toast(?string $message = null, ?string $title = null, NotificationInterface|string $type = NotificationInterface::SUCCESS, array $options = []): Envelope
    {
        // @phpstan-ignore-next-line
        return pnotify()->timer(2000)->addFlash(type: $type, message: $message, title: $title, options: $options);
    }
}

if(! function_exists('reset_cached_permissions')) {
    function reset_cached_permissions(): void
    {
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
    }
}
