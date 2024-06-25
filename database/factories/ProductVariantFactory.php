<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductVariantFactory extends Factory
{
    protected $model = ProductVariant::class;

    public function definition(): array
    {
        return [
            'price' => fake()->numberBetween(),
            'quantity' => fake()->numberBetween(1, 100),
            'name' => fake()->name(),
            'description' => fake()->text(),

            'product_id' => Product::factory(),
        ];
    }
}
