<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AccountType;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AccountTypeSeeder::class,
            ClientTypeSeeder::class,
            CollegeSeeder::class,
            DepartmentSeeder::class,
            DegreeProgramSeeder::class,
            ClientSeeder::class,
        ]);
    }
}
