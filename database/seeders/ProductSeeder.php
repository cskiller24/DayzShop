<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        Store::factory()
            ->count(3)
            ->create()
            ->each(function (Store $store) {
                Product::factory()
                    ->count(10)
                    ->hasVariants(mt_rand(1, 3))
                    ->state(['store_id' => $store->id])
                    ->create();
            });
    }
}
