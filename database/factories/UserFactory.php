<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\Type;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    protected static ?string $password;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'type' => Type::CUSTOMER->value,
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    private function modifyType(Type $type): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => $type->value,
        ]);
    }

    public function admin(): static
    {
        return $this->modifyType(Type::ADMIN);
    }

    public function courier()
    {
        return $this->modifyType(Type::COURIER);
    }

    public function customer(): static
    {
        return $this->modifyType(Type::CUSTOMER);
    }

    public function seller(): static
    {
        return $this->modifyType(Type::SELLER);
    }
}
