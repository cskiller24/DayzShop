<?php

declare(strict_types=1);

namespace App\Utils\Faker;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RandomImage
{
    private string $directory;

    private string $disk;

    public function __construct()
    {
        $this->directory = \config('app.faker_image_directory'); // @phpstan-ignore-line
        $this->disk = \config('app.faker_image_disk'); // @phpstan-ignore-line
    }

    public function setDirectory(string $directory): static
    {
        $this->directory = $directory;

        return $this;
    }

    public function setDisk(string $disk): static
    {
        $this->disk = $disk;

        return $this;
    }

    /**
     * Get random image in directory format
     */
    public function randomImage(bool $withTemporary = false): string
    {
        $disk = Storage::disk($this->disk);

        $parsedFiles = collect($disk->allFiles($this->directory))->take(3);

        if (! $withTemporary) {
            return $disk->path($parsedFiles->random());
        }

        $randomFile = $parsedFiles->random();
        $copiedFile = "{$this->directory}/tmp/{$this->generateRandomName()}.jpg";

        $disk->copy($randomFile, $copiedFile);

        return $disk->path($copiedFile);
    }

    private function generateRandomName(): string
    {
        return Str::ulid()->toString();
    }
}
