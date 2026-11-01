<?php

namespace Database\Seeders;

use App\Modules\Membership\Database\Seeders\MemberSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminSeeder::class,
            MemberSeeder::class,
        ]);
    }
}
