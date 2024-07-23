<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RolesAndPermissionSeeder extends Seeder
{
    public const string DAYZSHOP_ADMIN = "dayzshop.admin";
    public const string DAYZSHOP_CUSTOMER = "customer";
    public const string DAYZSHOP_SELLER = "seller";

    public function run(): void
    {
        static::createForAdmin();
    }

    protected static function createForAdmin(): void
    {
        $inviteIds = static::bulkCreate('invite');
        $storeIds = static::bulkCreate('store');
        $roleIds = static::bulkCreate('role');
        $permissionsIds = static::bulkCreate('permissions');

        Role::create(['name' => self::DAYZSHOP_ADMIN])
            ->syncPermissions(array_merge($inviteIds, $storeIds, $roleIds, $permissionsIds));
    }

//    private function createForCustomer(): void
//    private function createForCourier(): void
//    private function createForSeller(): void
//

    /**
     * @param  string  $moduleName
     * @param  array<int, string> $permissions
     * @return array<int, int>
     */
    protected static function bulkCreate(string $moduleName, array $permissions = Permission::VERBS): array
    {
        $parsedModuleName = str($moduleName)->lower()->snake();

        return collect($permissions)
            ->map(function ($permissionName) use ($parsedModuleName) {
                $separator = Permission::SEPARATOR;
                $id = Str::orderedUuid()->toString();
                DB::table('permissions')
                    ->insert(['id' => $id, 'name' => "{$parsedModuleName}{$separator}{$permissionName}", 'guard_name' => 'web']);

                return $id;
            })->toArray();
    }
}
