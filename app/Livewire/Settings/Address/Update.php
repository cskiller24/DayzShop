<?php

declare(strict_types=1);

namespace App\Livewire\Settings\Address;

use App\Livewire\Forms\Address as AddressForm;
use App\Models\Address;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Update extends Component
{
    public string $modalId;

    public AddressForm $form;

    public function mount(string $modalId = 'address-edit'): void
    {
        $this->modalId = $modalId;

    }

    #[On('address-edit')]
    public function setAddressAndOpen(Address $address): void
    {
        // TODO: AUTHORIZATION

        $this->form->setAddress($address);

        $this->openModal($this->modalId);
    }

    public function update(): void
    {
        // TODO: AUTHORIZATION
        $this->form->validate();

        $this->form->update();

        $this->flashMessage('Address updated successfully');
        $this->closeModal($this->modalId);
    }

    public function render(): View
    {
        return view('livewire.settings.address.update');
    }
}
