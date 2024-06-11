<?php

namespace App\Http\Middleware;

use App\Enums\Type;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ValidType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $type): Response
    {
        if (Type::tryFrom($type) === null) {
            $allowedTypes = implode(',', Type::getValues());
            throw new \InvalidArgumentException("Invalid type [{$type}] is used, only [{$allowedTypes}] is allowed");
        }

        /** @var \App\Models\User|null $user */
        $user = $request->user();

        if ($user === null || $user->type !== $type) {
            return redirect()->toRole($user);
        }

        return $next($request);
    }
}
