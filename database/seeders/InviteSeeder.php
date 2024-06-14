<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Invite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InviteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Invite::factory()->count(100)->create();
    }
}
