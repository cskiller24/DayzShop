<?php

declare(strict_types=1);

namespace App\Livewire\Forms;

use App\Models\Address as AddressModel;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Validate;
use Livewire\Form;

class Address extends Form
{
    public ?AddressModel $address;

    #[Validate('required')]
    public ?string $line_one = null;

    #[Validate('nullable')]
    public ?string $line_two = null;

    #[Validate('nullable')]
    public ?string $city = null;

    #[Validate('nullable')]
    public ?string $region = null;

    #[Validate('nullable')]
    public ?string $country = null;

    #[Validate('required')]
    public ?string $zip_code = null;

    public function setAddress(AddressModel $address): static
    {
        $this->address = $address;

        $this->fill($address->only([
            'line_one',
            'line_two',
            'city',
            'region',
            'country',
            'zip_code',
        ]));

        return $this;
    }

    /**
     * @throws ValidationException
     */
    public function store(): ?AddressModel
    {
        if($this->address) {
            return null;
        }

        return AddressModel::query()->create($this->validate());
    }

    public function update(): bool|null
    {
        return $this->address?->update($this->validate());
    }

    public function destroy(): bool|null
    {
        return $this->address?->delete();
    }
}
