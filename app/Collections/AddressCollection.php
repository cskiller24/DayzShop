<?php

declare(strict_types=1);

namespace App\Collections;

use App\Models\Address;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Exceptions\PublicPropertyNotFoundException;

/**
 * @mixin \App\Models\Address
 */
class AddressCollection extends Collection
{
    public function setAllAsInactive(): Collection
    {
        $this->toQuery()->update(['is_active' => false]);

        return $this;
    }

    public function withoutActive(): Collection
    {
        return $this->filter(fn(Address $address): bool => ! $address->is_active);
    }

    public function onlyActive(): Address
    {
        return $this->filter(fn(Address $address): bool => $address->is_active)->first();
    }
}
