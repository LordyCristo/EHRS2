<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AccountType;
class AccountTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AccountType::factory()->create(['name' => 'Nurse']);
        AccountType::factory()->create(['name' => 'Doctor']);
        AccountType::factory()->create(['name' => 'Receptionist']);
        AccountType::factory()->create(['name' => 'Administrator']);
    }
}
