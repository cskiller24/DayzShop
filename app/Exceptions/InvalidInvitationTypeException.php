<?php

declare(strict_types=1);

namespace App\Exceptions;

use App\Enums\InvitationTypes;
use App\Models\Invite;
use \Exception;

class InvalidInvitationTypeException extends Exception
{
    public function __construct(Invite $invite, InvitationTypes $type = null)
    {
        $allowedTypes = $type ?
            [$type->value] :
            InvitationTypes::getValues();

        $exploded = implode(", ", $allowedTypes);

        parent::__construct("Invalid notification type [{$invite->type}] given. [{$exploded}]");
    }
}
