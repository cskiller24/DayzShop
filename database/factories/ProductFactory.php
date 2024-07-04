<?php

namespace Database\Factories;

use App\Models\Category;
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

    public function withImages(int $count = 1, string $collection = 'default'): static
    {
        return $this->afterCreating(function (Product $product) use ($count, $collection) {
            $image = fake()->randomImage(true);

            for ($i = 0; $i < $count; $i++) {
                $product->addMedia($image)->toMediaCollection($collection);
            }
        });
    }

    public function withCategories(): static
    {
        return $this->afterCreating(
            /**
             * @param  Product  $product
             * @return void
             */
            callback: function (Product $product) {
                $categories = Category::factory()->count(mt_rand(1, 3))->state(['store_id' => $product->store_id])->create();

                $product->categories()->sync($categories);
            });
    }
}
