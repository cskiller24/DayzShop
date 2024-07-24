<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Role;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;

class SellerSeeder extends Seeder
{
    public function run(): void
    {
        $store = tap(Store::factory()->create(), function (Store $store) {
            $store->each(function (Store $store) {
                $products = Product::factory()
                    ->count(mt_rand(1, 10))
                    ->withImages()
                    ->withCategories()
                    ->createQuietly(['store_id' => $store->id]);

                $products->each(function (Product $product) {
                    ProductVariant::factory()
                        ->count(mt_rand(1, 3))
                        ->withImage()
                        ->createQuietly([
                            'product_id' => $product->id,
                        ]);
                });
            });
        });

        $productPermissionIds = Permission::bulkInsert('product');
        $categoryPermissionIds = Permission::bulkInsert('category');

        $sellerRole = Role::create(['name' => "seller", 'team_id' => $store->id])
            ->syncPermissions(array_merge($productPermissionIds, $categoryPermissionIds));

        User::factory()
            ->seller()
            ->create([
                'name' => 'Seller',
                'email' => 'seller@dayzshop.com',
            ])->each(function (User $user) use ($sellerRole, $store) {
                $user->load('roles');
                setPermissionsTeamId($user->id);
                $user->assignRole($sellerRole);
                $user->stores()->save($store);
            });
    }
}
