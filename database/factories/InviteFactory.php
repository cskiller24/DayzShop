<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\InvitationTypes;
use App\Models\Invite;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invite>
 */
class InviteFactory extends Factory
{
    protected $model = Invite::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => Str::random(),
            'type' => fake()->randomElement([InvitationTypes::STORE->value, InvitationTypes::COURIER->value]),
            'expire_at' => fake()->dateTimeBetween(now()->addDay(), now()->addMonth()),
        ];
    }

    public function storeInvite(): static
    {
        return $this->state(fn () => [
            'type' => InvitationTypes::STORE->value,
        ]);
    }

    public function courierInvite(): static
    {
        return $this->state(fn () => [
            'type' => InvitationTypes::COURIER->value,
        ]);
    }

    public function expired(): static
    {
        return $this->state(fn () => [
            'expire_at' => fake()->dateTimeBetween(now()->subYear(), now()->subDay()),
        ]);
    }
}
