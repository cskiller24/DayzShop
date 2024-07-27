<?php

declare(strict_types=1);

namespace App\Policies;

use App\Concerns\VerbAuthorization;
use App\Models\User;

class StorePolicy
{
    use VerbAuthorization;

    public  function getModuleName(): string
    {
        return 'Store';
    }

    public function viewAny(User $user): bool
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
}
