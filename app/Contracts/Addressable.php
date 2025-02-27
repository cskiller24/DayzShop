<?php

declare(strict_types=1);

namespace App\Contracts;

interface Addressable
{
    public function addresses(): \Illuminate\Database\Eloquent\Relations\MorphMany;
}
