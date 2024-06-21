<?php

declare(strict_types=1);

namespace App\Services;

use App\Contracts\GenerateImage;

class ImageGeneratorService implements GenerateImage
{
    private string $color;

    private string $backgroundColor;

    public const string URL = 'https://ui-avatars.com/api/';

    public function setColor(string $color): static
    {
        $this->color = $color;

        return $this;
    }

    public function setBackgroundColor(string $color): static
    {
        $this->backgroundColor = $color;

        return $this;
    }

    public function toUrl(string $name): string
    {
        $color = $this->color ?? $this->randomColor();
        $backgroundColor = $this->backgroundColor ?? $this->randomColor();

        return self::URL.'?'.http_build_query(['name' => $name, 'color' => $color, 'background' => $backgroundColor]);
    }

    private function randomColor(): string
    {
        return str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
    }
}
