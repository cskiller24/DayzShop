<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureCourierDoesHaveAnyHubs
{
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
        $user = $request->user();

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
}
