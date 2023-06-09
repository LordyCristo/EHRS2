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
            ClientTypeSeeder::class,
            CollegeSeeder::class,
            DepartmentSeeder::class,
            DegreeProgramSeeder::class,
            ServicesSeeder::class,

            UserSeeder::class,
            ClientSeeder::class,
            FeesSeeder::class,

//            PaymentSeeder::class,
//            PaymentsServiceSeeder::class,
            // HematologySeeder::class,
//            HematologySeeder::class,
//            FecalysisSeeder::class,
//            UrinalysisSeeder::class,
//
//            HematologyRecordSeeder::class,
//            FecalysisRecordSeeder::class,
        ]);
    }
}
