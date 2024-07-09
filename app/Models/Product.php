<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\ByStoreIdScope;
use App\Observers\ApplyStoreIdObserver;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Maize\Searchable\HasSearch;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

#[ScopedBy(ByStoreIdScope::class)]
#[ObservedBy(ApplyStoreIdObserver::class)]
class Product extends Model implements HasMedia
{
    use HasFactory, HasUuids, InteractsWithMedia, HasSearch;

    protected $with = ['variants'];

    protected $fillable = [
        'store_id',
        'name',
        'description',
        'specifications',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function highestVariantPrice(): Money
    {
        return $this->variants->max('price');
    }

    public function lowestVariantPrice(): Money
    {
        return $this->variants->min('price');
    }

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'id' => 'string',
            'specifications' => 'array',
        ];
    }

    /**
     * @return array<int, string>
     */
    public function getSearchableAttributes(): array
    {
        return [
            'name',
            'description',
            'specifications.*',
            'variants.name',
            'variants.description',
        ];
    }

}
