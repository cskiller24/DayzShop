<?php

namespace Database\Factories;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoleFactory extends Factory
{
    protected $model = Role::class;

    public function definition(): array
    {
        return [
            'name' => fake()->unique()->words(asText: true),
        ];
    }

    public function withPermissions(): static
    {
        return $this->afterCreating(function (Role $role) {
            $permissions = Permission::factory()->count(mt_rand(1, 3))->create();

            $role->syncPermissions($permissions);
        });
    }
}
