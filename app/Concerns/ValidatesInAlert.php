<?php

namespace App\Concerns;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

/**
 * @mixin Component
 */
trait ValidatesInAlert
{
    public function validateAlert(?array $rules = null, array $messages = [], array $attributes = []): array
    {
        try {
            return $this->validate();
        } catch (ValidationException $validationException) {
            $this->dispatch('flash-reset');
            foreach ($validationException->errors() as $key => $messages) {
                foreach ($messages as $message) {
                    $this->dispatch('flash-alert', message: $message, type: 'error');
                }
            }

            throw ValidationException::withMessages([]);
        }
    }

    public function validateOnAlert(array $data, array $rules, array $messages = [], array $attributes = [])
    {
        try {
            return Validator::make($data, $rules, $messages, $attributes)->validate();
        } catch (ValidationException $validationException) {
            $this->dispatch('flash-reset');
            foreach ($validationException->errors() as $key => $messages) {
                foreach ($messages as $message) {
                    $this->dispatch('flash-alert', message: $message, type: 'error');
                }
            }

            throw ValidationException::withMessages([]);
        }
    }
}
