<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\ByStoreIdScope;
use App\Observers\ApplyStoreIdObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ScopedBy(ByStoreIdScope::class)]
#[ObservedBy(ApplyStoreIdObserver::class)]
class Category extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'store_id',
        'name',
    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'string',
        ];
    }
}
