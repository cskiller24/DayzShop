<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Invitation;
use Illuminate\Support\Str;

class HandlesInviteCode
{
    public function creating(Invitation $invitation): void
    {
        do {
            $code = Str::random();
        } while(Invitation::query()->where('code', $code)->exists());

        $invitation->code = $code;
    }
}
