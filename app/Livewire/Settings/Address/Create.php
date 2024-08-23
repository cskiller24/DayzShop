<?php

declare(strict_types=1);

namespace App\Livewire\Settings\Address;

use App\Models\Address;
use App\Models\Store;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Livewire\Attributes\Validate;
use Livewire\Component;

class Create extends Component
{
    public const MODAL_ID = 'address-create';

    public const EVENT = 'address.create';

    #[Validate('required')]
    public string $line_one;

    #[Validate('nullable')]
    public string $line_two;

    #[Validate('nullable')]
    public string $city;

    #[Validate('nullable')]
    public string $region;

    #[Validate('nullable')]
    public string $country;

    #[Validate('required')]
    public string $zip_code;

    public function store(): void
    {
        $data = $this->validate();

        Address::create(array_merge($data, $this->fromWho()));

        $this->flashMessage('Address added successfully');

        $this->closeModal(self::MODAL_ID);
    }

    public function fromWho(): array
    {
        /** @var User $user */
        $user = auth()->user();

        return match (true) {
            $user->isSeller() => ['addressable_type' => Store::class, 'addressable_id' => $user->store->id],
            $user->isCustomer() => ['addressable_type' => User::class, 'addressable_id' => $user->id],
            default => ValidationException::withMessages(['message' => 'Invalid authorizations'])
        };
    }

    public function render(): View
    {
        return view('livewire.settings.address.create');
    }
}
