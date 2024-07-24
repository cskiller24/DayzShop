<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

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


}
