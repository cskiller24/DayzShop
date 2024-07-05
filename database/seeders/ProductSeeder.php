<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Store::factory()
            ->count(3)
            ->create()
            ->each(function (Store $store) {
                $products = Product::factory()
                    ->count(mt_rand(1, 15))
                    ->withImages()
                    ->withCategories()
                    ->create(['store_id' => $store->id]);

                $products->each(function (Product $product) {
                    ProductVariant::factory()
                        ->count(mt_rand(1, 3))
                        ->withImage()
                        ->createQuietly([
                            'product_id' => $product->id
                        ]);
                });
            });
    }
}
