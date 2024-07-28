<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // User::factory(10)->create();

        reset_cached_permissions();

        $this->call(AdminSeeder::class);
        $this->call(SellerSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CourierSeeder::class);
        $this->call(InviteSeeder::class);

        User::factory()->unverified()->create([
            'name' => 'Unverified',
            'email' => 'unverified@dayzshop.com',
        ]);

    }
}
