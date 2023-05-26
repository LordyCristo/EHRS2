<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AccountRoleSeeder::class,
            ServicesSeeder::class,
            ClientTypeSeeder::class,
            FeesSeeder::class,
            CollegeSeeder::class,
            DepartmentSeeder::class,
            DegreeProgramSeeder::class,
            UserSeeder::class,
            ClientSeeder::class,
            HematologySeeder::class,
            HematologyRecordSeeder::class,
            PaymentSeeder::class,
        ]);
    }
}
