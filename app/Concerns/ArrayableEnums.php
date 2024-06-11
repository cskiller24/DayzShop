<?php

declare(strict_types=1);

namespace App\Concerns;

trait ArrayableEnums
{
    /**
     * @return array<int, string>
     */
    public static function getNames(): array
    {
        return array_column(static::cases(), 'name');
    }

    /**
     * @return array<int, string>
     */
    public static function getValues(): array
    {
        return array_column(static::cases(), 'value');
    }

    /**
     * @return array<string, string>
     */
    public static function toArray(): array
    {
        return array_combine(static::getNames(), static::getValues());
    }
}
