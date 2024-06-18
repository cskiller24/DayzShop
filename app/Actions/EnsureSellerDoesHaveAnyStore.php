<?php

declare(strict_types=1);

namespace App\Actions;

use Illuminate\Http\RedirectResponse;
use Livewire\Component;
use Livewire\Features\SupportRedirects\Redirector;

class EnsureSellerDoesHaveAnyStore
{
    public static function handleController(): ?RedirectResponse
    {
        /**
         * @var \App\Models\User $user
         */
        $user = auth()->user();

        if($user === null || ! $user->isSeller()) {
            return null;
        }

        $storeCount = $user->stores()->count();

        if($storeCount > 0 && $user->active_store_id !== null) {
            return null;
        }

        if($storeCount > 0 && $user->active_store_id === null) {
            return redirect()->route('seller.select');
        }

        if($storeCount <= 0) {
            $user->update(['active_store_id' => null]);

            return redirect()->route('seller.create');
        }

        return null;
    }

    public static function handleLivewire(Component $livewire, bool $navigate = true): ?Redirector
    {
        /**
         * @var \App\Models\User $user
         */
        $user = auth()->user();

        if($user === null || ! $user->isSeller()) {
            return $livewire->redirect;
        }

        $storeCount = $user->stores()->count();

        if($storeCount > 0 && $user->active_store_id !== null) {
            return null;
        }

        if($storeCount > 0 && $user->active_store_id === null) {
            return $livewire->redirect(route('seller.create'), $navigate);
        }

        if($storeCount <= 0) {
            $user->update(['active_store_id' => null]);

            return $livewire->redirect(route('seller.create'), $navigate);
        }

        return null;
    }
}
