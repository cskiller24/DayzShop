<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\InvitationTypes;
use App\Observers\HandlesInviteCodeCreation;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read string $url
 * @property-read string $status
 */
#[ObservedBy(HandlesInviteCodeCreation::class)]
class Invite extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'code', 'expire_at',
    ];

    public function status(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->expire_at->lessThan(now()) ? 'Expire' : 'Available', // @phpstan-ignore-line
        );
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: fn (): string => route('invitation.use', $this->code),
        );
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'type' => InvitationTypes::class,
            'expire_at' => 'datetime',
        ];
    }
}
