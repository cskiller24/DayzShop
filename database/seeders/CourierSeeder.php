<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CourierSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->courier()->create([
            'name' => 'Courier',
            'email' => 'courier@dayzshop.com',
        ]);
    }
}
