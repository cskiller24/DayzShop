<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Type;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property \App\Enums\Type $type
 */
class User extends Authenticatable implements CanResetPassword, MustVerifyEmail
{
    use HasFactory, HasUuids, Notifiable;

    public $incrementing = false;

    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'active_store_id',
        'active_courier_id',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'string',
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'type' => Type::class,
        ];
    }

    public function isAdmin(): bool
    {
        return $this->type === Type::ADMIN;
    }

    public function isCourier(): bool
    {
        return $this->type === Type::COURIER;
    }

    public function isCustomer(): bool
    {
        return $this->type === Type::CUSTOMER;
    }

    public function isSeller(): bool
    {
        return $this->type === Type::SELLER;
    }

    public function stores(): BelongsToMany
    {
        return $this->belongsToMany(Store::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'active_store_id');
    }

    public function setAsActive(Store|Courier $classification): void
    {
        $column = $classification::class === Store::class ? 'active_store_id' : 'active_courier_id';

        $this->forceFill([$column => $classification->id])->save();
    }

    // public function courier(): BelongsTo
    // {
    //     return $this->belongsTo(Store::)
    // }
}
