<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Address;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'line_one' => fake()->streetAddress(),
            'line_two' => fake()->streetAddress(),
            'city' => fake()->city(),
            'region' => fake()->state(),
            'country' => fake()->country(),
            'zip_code' => fake()->postcode(),
        ];
    }
}
