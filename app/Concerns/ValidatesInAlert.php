<?php

declare(strict_types=1);

namespace App\Concerns;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

/**
 * @mixin Component
 */
trait ValidatesInAlert
{
    /**
     * @param  array<int, string|Rule|mixed>|null  $rules
     * @param  array<string, mixed>  $messages
     * @param  array<string, mixed>  $attributes
     * @return array<string, mixed>
     */
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

    /**
     * @param  array<string, mixed>  $data
     * @param  array<mixed, string|Rule|mixed>  $rules
     * @param  array<string, mixed>  $messages
     * @param  array<string, mixed>  $attributes
     * @return array<string, mixed>
     */
    public function validateOnAlert(array $data, array $rules, array $messages = [], array $attributes = []): array
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
