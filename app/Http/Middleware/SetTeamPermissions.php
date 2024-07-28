<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetTeamPermissions
{
    /**
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var User|null $user */
        $user = $request->user();

        if ($user === null) {
            setPermissionsTeamId(null);
            return $next($request);
        }

        if ($user->isSeller()) {
            setPermissionsTeamId($user->active_store_id);
        }

        if ($user->isCourier()) {
            setPermissionsTeamId($user->active_courier_id);
        }

        if($user->isAdmin()) {
            setPermissionsTeamId(Permission::DEFAULT_ADMIN_TEAM);
        }

        return $next($request);
    }
}
