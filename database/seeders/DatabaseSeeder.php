<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([InviteSeeder::class, ProductSeeder::class]);
        // User::factory(10)->create();

        User::factory()->admin()->create([
            'name' => 'Admin',
            'email' => 'admin@dayzshop.com',
        ]);

        User::factory()->courier()->create([
            'name' => 'Courier',
            'email' => 'courier@dayzshop.com',
        ]);

        User::factory()->customer()->create([
            'name' => 'Customer',
            'email' => 'customer@dayzshop.com',
        ]);

        User::factory()
            ->seller()
            ->create([
                'name' => 'Seller',
                'email' => 'seller@dayzshop.com',
            ])
            ->stores()
            ->sync(Store::all());

        // User::factory()->create([
        //     'name' => 'Limbo',
        //     'email' => 'limbo@dayzshop.com',
        //     'type' => Str::random(5),
        // ]);

        User::factory()->unverified()->create([
            'name' => 'Unverified',
            'email' => 'unverified@dayzshop.com',
        ]);

    }
}
