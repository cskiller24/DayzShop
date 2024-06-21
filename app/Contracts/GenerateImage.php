<?php

declare(strict_types=1);

namespace App\Contracts;

/**
 * Generates a random image service to the app
 *
 * From text to image
 */
interface GenerateImage
{
    public function setColor(string $color): static;

    public function setBackgroundColor(string $color): static;

    public function toUrl(string $name): string;
}
