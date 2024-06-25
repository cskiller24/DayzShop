<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'description' => $this->faker->text(),
            'specifications' => [
                fake()->word() => fake()->word(),
                fake()->word() => fake()->word(),
            ],

            'store_id' => Store::factory(),
        ];
    }
}
