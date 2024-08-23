<?php

declare(strict_types=1);

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission as SpatiePermission;

class Permission extends SpatiePermission
{
    use HasFactory, HasUuids;

    public const array VERBS = ['list', 'create', 'read', 'update', 'delete'];

    public const string DEFAULT_ADMIN_TEAM = 'cd5c5e0e-1993-43fd-b166-a05f1266361f';

    public const string SEPARATOR = '::';

    public function permissionName(): Attribute
    {
        return Attribute::make(get: fn (): string => explode(static::SEPARATOR, $this->name)[0]); // @phpstan-ignore-line
    }

    public function verbName(): Attribute
    {
        return Attribute::make(get: fn (): string => explode(static::SEPARATOR, $this->name)[1]); // @phpstan-ignore-line
    }

    /**
     * @param  array<int, string>  $permissions
     * @return array<int, string>
     */
    public static function bulkInsert(string $moduleName, array $permissions = Permission::VERBS): array
    {
        $parsedModuleName = str($moduleName)->lower()->snake();

        /**
         * @var array<int, string> $toReturn
         */
        $toReturn = collect($permissions)
            ->map(function ($permissionName) use ($parsedModuleName) {
                $separator = Permission::SEPARATOR;
                $id = Str::orderedUuid()->toString();
                DB::table('permissions')
                    ->insert([
                        'id' => $id,
                        'name' => "{$parsedModuleName}{$separator}{$permissionName}",
                        'guard_name' => 'web',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]);

                return $id;
            })->toArray();

        return $toReturn;
    }
}
