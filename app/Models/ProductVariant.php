<?php

declare(strict_types=1);

namespace App\Models;

use Cknow\Money\Casts\MoneyIntegerCast;
use Cknow\Money\Money;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property string $id
 * @property Money $price
 * @property int $quantity
 * @property string $name
 * @property string|null $description
 * @property string $product_id
 * @property string|null $media_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Media|null $media
 * @property-read Product $product
 * @method static \Database\Factories\ProductVariantFactory factory($count = null, $state = [])
 * @method static Builder|ProductVariant newModelQuery()
 * @method static Builder|ProductVariant newQuery()
 * @method static Builder|ProductVariant query()
 * @method static Builder|ProductVariant whereCreatedAt($value)
 * @method static Builder|ProductVariant whereDescription($value)
 * @method static Builder|ProductVariant whereId($value)
 * @method static Builder|ProductVariant whereMediaId($value)
 * @method static Builder|ProductVariant whereName($value)
 * @method static Builder|ProductVariant wherePrice($value)
 * @method static Builder|ProductVariant whereProductId($value)
 * @method static Builder|ProductVariant whereQuantity($value)
 * @method static Builder|ProductVariant whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ProductVariant extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'price',
        'quantity',
        'name',
        'description',
        'product_id',
        'media_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function media(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    /**
     * @return array<string, mixed>
     */
    protected function casts(): array
    {
        return [
            'id' => 'string',
            'price' => MoneyIntegerCast::class,
        ];
    }
}
