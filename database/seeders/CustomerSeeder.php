<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->customer()->create([
            'name' => 'Customer',
            'email' => 'customer@dayzshop.com',
        ]);
    }
}
