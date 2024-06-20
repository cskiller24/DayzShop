<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\InvitationTypes;
use App\Enums\Type;
use App\Observers\HandlesInviteCodeCreation;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property-read string $url
 * @property-read string $status
 * @property-read string $role_type
 * @property-read bool $is_expired
 * @property \App\Enums\InvitationTypes $type
 * @property int $id
 * @property string $code
 * @property bool $is_used
 * @property \Illuminate\Support\Carbon $expire_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\InviteFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Invite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invite query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invite whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invite whereExpireAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invite whereIsUsed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invite whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Invite whereUpdatedAt($value)
 * @mixin \Eloquent
 */
#[ObservedBy(HandlesInviteCodeCreation::class)]
class Invite extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'code', 'expire_at', 'is_used',
    ];

    public function status(): Attribute
    {
        return Attribute::make(
            get: fn (): string => $this->expire_at->lessThan(now()) ? 'Expire' : 'Available',
        );
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: fn (): string => route('invitation.use', $this->code),
        );
    }

    public function isExpired(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->expire_at->lessThan(now()),
        );
    }

    public function roleType(): Attribute
    {
        if ($this->type === InvitationTypes::COURIER || $this->type === InvitationTypes::COURIER_USER) {
            return Attribute::make(
                get: fn () => Type::COURIER->value,
            );
        }

        return Attribute::make(
            get: fn () => Type::SELLER->value,
        );
    }

    public function used(): static
    {
        $this->forceFill(['is_used' => true])->save();

        return $this;
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
