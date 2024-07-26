<?php

declare(strict_types=1);

namespace App\Concerns;

use App\Models\Permission;
use App\Models\User;

trait VerbAuthorization
{
    abstract function getModuleName(): string;

    public function getSeparator(): string
    {
        return Permission::SEPARATOR;
    }

    public function parseAuthorization(string $verb, User $user = null): string
    {
        return str($this->getModuleName())->lower()->snake().$this->getSeparator().$verb;
    }
}
