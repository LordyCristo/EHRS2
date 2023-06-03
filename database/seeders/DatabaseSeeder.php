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
            CollegeSeeder::class,
            DepartmentSeeder::class,
            DegreeProgramSeeder::class,
            UserSeeder::class,
            //ClientSeeder::class,
            FeesSeeder::class,
//            PaymentSeeder::class,
//            HematologySeeder::class,
//            FecalysisSeeder::class,
//            UrinalysisSeeder::class,
//            PaymentsServiceSeeder::class,
//            HematologyRecordSeeder::class,
//            FecalysisRecordSeeder::class,
        ]);
    }
}
