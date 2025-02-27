<?php

declare(strict_types=1);

namespace App\Utils\Faker;

use Random\Randomizer;

class NumberDivisibleBy
{
    /**
     * @return array<int, int>
     */
    protected function generateRangedArray(int $min, int $max, int $divisibleBy): array
    {
        return range($min, $max, $divisibleBy);
    }

    public function numberDivisibleBy(int $min, int $max, int $divisibleBy): int
    {
        $generatedArray = $this->generateRangedArray($min, $max, $divisibleBy);
        $key = (new Randomizer())->pickArrayKeys($generatedArray, 1);

        return $generatedArray[$key[0]];
    }

    public function numberDivisibleBy100(int $min = 100, int $max = 100_000): int
    {
        return $this->numberDivisibleBy($min, $max, 100);
    }

    public function numberDivisibleBy1000(int $min = 1000, int $max = 1_000_000): int
    {
        return $this->numberDivisibleBy($min, $max, 1000);
    }
}
