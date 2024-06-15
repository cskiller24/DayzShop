<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsNotVerified
{
    public static function redirectTo(string $route): string
    {
        return static::class.':'.$route;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ?string $redirectToRoute = null): Response
    {
        if (
            ! $request->user() ||
            ($request->user() instanceof MustVerifyEmail && $request->user()->hasVerifiedEmail())
        ) {
            return $request->expectsJson()
                ? abort(403, 'Your email address is verified.')
                : Redirect::guest(URL::route($redirectToRoute ?: 'welcome'));
        }

        return $next($request);
    }
}
