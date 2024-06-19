<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\User;
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
        /** @var App\Models\User|null $user */
        $user = auth()->user();

        if ($this->shouldPassThrough($user)) {
            return $next($request);
        }

        return $this->handleSeller($user, $request, $next);
    }

    private function shouldPassThrough(?User $user): bool
    {
        return $user === null || !$user->isSeller();
    }

    private function handleSeller(User $user, Request $request, Closure $next): Response
    {
        $storeCount = $user->stores()->count();

        if ($this->hasActiveStore($user, $storeCount)) {
            return $next($request);
        }

        if ($this->shouldRedirectToSelectStore($user, $storeCount, $request)) {
            return redirect()->route('seller.select');
        }

        if ($this->shouldRedirectToCreateStore($storeCount, $request)) {
            $user->update(['active_store_id' => null]);

            return redirect()->route('seller.create');
        }

        return $next($request);
    }

    private function hasActiveStore(User $user, int $storeCount): bool
    {
        return $storeCount > 0 && $user->active_store_id !== null;
    }

    private function shouldRedirectToSelectStore(User $user, int $storeCount, Request $request): bool
    {
        return $storeCount > 0
            && $user->active_store_id === null
            && !in_array($request->route()?->getName() ?? '', $this->except);
    }

    private function shouldRedirectToCreateStore(int $storeCount, Request $request): bool
    {
        return $storeCount <= 0
            && !in_array($request->route()?->getName() ?? '', $this->except);
    }
}
