<?php

declare(strict_types=1);

namespace App\Concerns;

use App\Models\Permission;

trait VerbAuthorization
{
    abstract public function getModuleName(): string;

    public function getSeparator(): string
    {
        return Permission::SEPARATOR;
    }

    public function parseAuthorization(string $verb): string
    {
        return str($this->getModuleName())->lower()->snake().$this->getSeparator().$verb;
    }
}
