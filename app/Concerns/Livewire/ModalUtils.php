<?php

declare(strict_types=1);

namespace App\Concerns\Livewire;

use Livewire\Component;

/**
 * @mixin Component
 */
trait ModalUtils
{
    private string $modalIdProperty;

    protected function setModalIdProperty(string $id): void
    {
        $this->modalIdProperty = $id;
    }

    protected function getModalId(): string
    {
        if(! property_exists($this, $this->modalIdProperty)) {
            throw new \InvalidArgumentException("Property {$this->modalIdProperty} does not exist.");
        }

        return $this->{$this->modalIdProperty};
    }

    public function openModal(?string $id = null): void
    {
        $id = $id ?? $this->getModalId();

        $this->js(
            "
                let myModal = document.getElementById('{$id}');
                let modalInstance = bootstrap.Modal.getInstance(myModal);
                modalInstance.hide();
        ");
    }

    public function closeModal(?string $id = null): void
    {
        $id = $id ?? $this->getModalId();

        $this->js(
            "
                let myModal = document.getElementById('{$id}');
                let modalInstance = bootstrap.Modal.getOrCreateInstance(myModal);
                modalInstance.show();
            "
        );
    }
}
