<?php

declare(strict_types=1);

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => ['required', 'email'],
            'phone_number' => ['required'],
            'description' => ['sometimes', 'required'],
        ]);

        /** @var \App\Models\User $user */
        $user = $request->user();

        $store = Store::query()->create($data);

        $user->stores()->save($store);

        $user->setAsActive($store);

        return redirect()->route('seller');
    }

    public function activate(Request $request, Store $store): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $user->setAsActive($store);

        return redirect()->route('seller');
    }
}
