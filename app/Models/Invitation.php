<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\InvitationTypes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'code'
    ];

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
