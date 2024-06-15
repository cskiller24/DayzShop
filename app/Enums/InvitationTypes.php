<?php

declare(strict_types=1);

namespace App\Enums;

use App\Concerns\ArrayableEnums;

enum InvitationTypes: string
{
    use ArrayableEnums;

    // For creating a store
    case STORE = 'store';

    // For inviting a user in a store
    case STORE_USER = 'store_user';

    // For creating a courier hub
    case COURIER = 'courier';

    // For inviting a user in a hub
    case COURIER_USER = 'courier_user';
}
