<?php

declare(strict_types=1);

namespace App\Livewire\Settings\Address\Components;

use App\Livewire\Settings\Address\Create;
use App\Models\Address;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public string $type;

    /**
     * @throws \Exception
     */
    public function mount(string $type = Address::USER): void
    {
        if (! Address::isValidType($type)) {
            throw new \Exception("Invalid address type. [{$type}] Given");
        }

        Address::cleanUpAddress($this->relationToAddressType($type));

        $this->type = $type;
    }

    private function relationToAddressType(string $type): User|Store
    {
        /** @var User $user */
        $user = auth()->user();

        return match ($type) {
            Address::USER => $user,
            Address::STORE => $user->store,
        };
    }

    /**
     * @throws \Throwable
     */
    public function setAsActive(string $id): void
    {
        DB::transaction(function () use ($id) {
            /** @var User $user */
            $user = auth()->user();

            Address::whereNot('id', $id)->update(['is_active' => false]);
            Address::where('id', $id)->update(['is_active' => true]);
        });

        $this->flashMessage('Set as active successfully!');
    }

    public function delete(string $id): void
    {
        $address = Address::query()->findOrFail($id);

        $this->authorize('destroy', $address);

        $address->delete();

        $this->flashMessage('Address deleted successfully.');
    }

    #[On(Create::EVENT)]
    public function render(): View
    {
        /** @var Collection<int, Address> $addresses */
        $addresses = $this->relationToAddressType($this->type)->addresses;

        return view('livewire.settings.address.components.index', compact('addresses'));
    }
}
