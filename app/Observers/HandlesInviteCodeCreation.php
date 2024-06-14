<?php

declare(strict_types=1);

namespace App\Observers;

use App\Models\Invite;
use Illuminate\Support\Str;

class HandlesInviteCodeCreation
{
    public function creating(Invite $invite): void
    {
        do {
            $code = Str::random();
        } while(Invite::query()->where('code', $code)->exists());

        $invite->code = $code;
    }
}
