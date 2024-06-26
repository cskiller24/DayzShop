<?php

declare(strict_types=1);

namespace App\Enums;

use App\Concerns\ArrayableEnums;

enum Type: string
{
    use ArrayableEnums;

    case ADMIN = 'admin';

    case SELLER = 'seller';

    case COURIER = 'courier';

    case CUSTOMER = 'customer';
}
