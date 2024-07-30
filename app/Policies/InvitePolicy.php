<?php

declare(strict_types=1);

namespace App\Policies;

use App\Concerns\VerbAuthorization;
use App\Models\User;

class InvitePolicy
{
    use VerbAuthorization;

    public function getModuleName(): string
    {
        return 'Invite';
    }

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo($this->parseAuthorization('list'));
    }

    public function view(User $user): bool
    {
        return $user->hasPermissionTo($this->parseAuthorization('list'));
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo($this->parseAuthorization('create'));
    }

    public function update(User $user): bool
    {
        return $user->hasPermissionTo($this->parseAuthorization('update'));
    }

    public function delete(User $user): bool
    {
        return $user->hasPermissionTo($this->parseAuthorization('delete'));
    }

    public function restore(User $user): bool
    {
        return $user->hasPermissionTo($this->parseAuthorization('restore'));
    }

    public function forceDelete(User $user): bool
    {
        return $user->hasPermissionTo($this->parseAuthorization('force-delete'));
    }

    public function notify(User $user): bool
    {
        return $user->hasPermissionTo($this->parseAuthorization('notify'));
    }
}
