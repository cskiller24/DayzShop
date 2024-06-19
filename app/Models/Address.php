<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'line_one',
        'line_two',
        'city',
        'region',
        'country',
        'zip_code',
    ];

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
