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
        [$word, $definition] = fake()->dictionary();

        return [
            'price' => fake()->numberDivisibleBy100(),
            'quantity' => fake()->numberDivisibleBy(min: 10, max: 100, divisibleBy: 10),
            'name' => $word,
            'description' => $definition,

            'product_id' => Product::factory(),
        ];
    }

    public function withImage(string $collection = 'default'): static
    {
        return $this->afterCreating(function (ProductVariant $variant) use ($collection) {
            $product = $variant->product()->withoutGlobalScopes()->first();

            $image = fake()->randomImage(true);
            $media = $product->addMedia($image)->toMediaCollection($collection);
            $variant->update(['media_id' => $media->id]);
        });
    }
}
