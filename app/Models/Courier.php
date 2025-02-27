<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CourierFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Courier newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Courier newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Courier query()
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Courier whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Courier extends Model
{
    use HasFactory;
}
