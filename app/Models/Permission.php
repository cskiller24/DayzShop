<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasFactory, HasUuids;

    public const array VERBS = ['list', 'create', 'read', 'update', 'delete'];

    public const string SEPARATOR = '::';

    public function permissionName(): Attribute
    {
        return Attribute::make(get: fn (): string => explode(static::SEPARATOR, $this->name)[0]);
    }

    public function verbName(): Attribute
    {
        return Attribute::make(get: fn (): string => explode(static::SEPARATOR, $this->name)[1]);
    }
}
