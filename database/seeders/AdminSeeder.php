<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $invitePermissionIds = Permission::bulkInsert('invite');
        $storePermissionIds = Permission::bulkInsert('store');
        $rolePermissionIds = Permission::bulkInsert('roles-permissions');

        $adminRole = Role::create(['name' => 'admin'])->syncPermissions(array_merge($invitePermissionIds, $storePermissionIds, $rolePermissionIds));

        User::factory()
            ->admin()
            ->create([
                'name' => 'Admin',
                'email' => 'admin@dayzshop.com',
            ])->each(function (User $user) use ($adminRole) {
                setPermissionsTeamId($user->id);
                $user->assignRole($adminRole);
            });
    }
}
