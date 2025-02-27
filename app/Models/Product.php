<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\ByStoreIdScope;
use App\Observers\ApplyStoreIdObserver;
use Cknow\Money\Money;
use Database\Factories\ProductFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Maize\Searchable\HasSearch;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;

#[ScopedBy(ByStoreIdScope::class)]
#[ObservedBy(ApplyStoreIdObserver::class)]
/**
 * @property string $id
 * @property string $store_id
 * @property string $name
 * @property string $description
 * @property array $specifications
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Category> $categories
 * @property-read int|null $categories_count
 * @property-read MediaCollection<int, Media> $media
 * @property-read int|null $media_count
 * @property-read Store $store
 * @property-read Collection<int, ProductVariant> $variants
 * @property-read int|null $variants_count
 * @method static ProductFactory factory($count = null, $state = [])
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @method static Builder|Product search(string $search, bool $orderByWeight = true)
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDescription($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product whereSpecifications($value)
 * @method static Builder|Product whereStoreId($value)
 * @method static Builder|Product whereUpdatedAt($value)
 */
class Product extends Model implements HasMedia
{
    use HasFactory, HasSearch, HasUuids, InteractsWithMedia;

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
        return $this->variants->max('price'); // @phpstan-ignore-line
    }

    public function lowestVariantPrice(): Money
    {
        return $this->variants->min('price'); // @phpstan-ignore-line
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
