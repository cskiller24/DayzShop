<?php

declare(strict_types=1);

namespace App\Models;

use App\Contracts\Addressable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * @property string $id
 * @property string $addressable_type
 * @property string $addressable_id
 * @property string|null $line_one
 * @property string|null $line_two
 * @property string|null $city
 * @property string|null $region
 * @property string|null $country
 * @property string|null $zip_code
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Model|\Eloquent $addressable
 * @property-read string $full_address
 * @method static \Database\Factories\AddressFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Address newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Address query()
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddressableId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereAddressableType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereLineOne($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereLineTwo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Address whereZipCode($value)
 * @mixin \Eloquent
 */
class Address extends Model
{
    use HasFactory, HasUuids;

    public const string STORE = 'store';

    public const string USER = 'user';

    protected $fillable = [
        'addressable_type',
        'addressable_id',
        'line_one',
        'line_two',
        'city',
        'region',
        'country',
        'zip_code',
        'is_active',
    ];

    public function fullAddress(): Attribute
    {
        return Attribute::make(
            get: fn () => implode(', ', array_filter([
                $this->line_one,
                $this->line_two,
                $this->city,
                $this->region,
                $this->country,
                $this->zip_code,
            ]))
        );
    }

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }

    public static function isValidType(string $type): bool
    {
        return in_array($type, [self::STORE, self::USER]);
    }

    public static function cleanUpAddress(Model $model): void
    {
        if (! $model instanceof Addressable) {
            throw new \InvalidArgumentException("The model {$model} doesn't have [App\Contracts\Addressable] interface.");
        }

        $activeCount = $model->addresses()->where('is_active', true)->count();
        $inactiveCount = $model->addresses()->where('is_active', false)->count();

        if ($activeCount > 1) {
            $model->addresses()->update(['is_active' => false]);
            $model->addresses()->first()?->update(['is_active' => true]);
        }

        if ($activeCount === 0 && $inactiveCount > 0) {
            $model->addresses()->first()?->update(['is_active' => true]);
        }
    }
}
