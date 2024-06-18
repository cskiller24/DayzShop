<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSellerDoesHaveAnyStore
{
    /**
     * @var array<int, string>
     */
    private array $except = [
        'seller.select',
        'seller.activate',
        'seller.store',
        'seller.create',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /**
         * @var \App\Models\User $user
         */
        $user = auth()->user();

        if($user === null || ! $user->isSeller()) {
            return $next($request);
        }

        $storeCount = $user->stores()->count();

        if($storeCount > 0 && $user->active_store_id !== null) {
            return $next($request);
        }

        if($storeCount > 0 && $user->active_store_id === null && ! in_array($request->route()->getName(), $this->except)) {
            return redirect()->route('seller.select');
        }

        if($storeCount <= 0 && ! in_array($request->route()->getName(), $this->except)) {
            $user->update(['active_store_id' => null]);

            return redirect()->route('seller.create');
        }

        return $next($request);
    }
}
