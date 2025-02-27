<?php

declare(strict_types=1);

namespace App\Collections;

use App\Models\Address;
use Illuminate\Database\Eloquent\Collection;

/**
 * @mixin \App\Models\Address
 */
class AddressCollection extends Collection
{
    public function setAllAsInactive(): static
    {
        $this->toQuery()->update(['is_active' => false]);

        return $this;
    }

    /**
     * @return static<int, Address>
     */
    public function withoutActive(): static
    {
        // @phpstan-ignore-next-line
        return $this->filter(fn (Address $address): bool => ! $address->is_active);
    }

    public function onlyActive(): Address|null
    {
        // @phpstan-ignore-next-line
        return $this->filter(fn (Address $address): bool => $address->is_active)->first();
    }
}
