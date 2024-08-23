<?php

declare(strict_types=1);

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: [
            base_path('routes/web.php'),
            base_path('routes/admin.php'),
            base_path('routes/courier.php'),
            base_path('routes/customer.php'),
            base_path('routes/seller.php'),
        ],
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'not-verified' => \App\Http\Middleware\EnsureEmailIsNotVerified::class,
            'type' => \App\Http\Middleware\ValidType::class,
        ]);

        $middleware->priority([
            \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
            //            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class,
            \Illuminate\Routing\Middleware\ThrottleRequestsWithRedis::class,
            \App\Http\Middleware\SetTeamPermissions::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Illuminate\Contracts\Auth\Middleware\AuthenticatesRequests::class,
            \Illuminate\Auth\Middleware\Authorize::class,
        ]);

        $middleware->web(append: [
            \App\Http\Middleware\EnsureSellerDoesHaveAnyStore::class,
            \App\Http\Middleware\SetTeamPermissions::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
