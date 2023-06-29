<?php

namespace Database\Seeders;

use App\Models\AccountRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            'Administrator',
            'Physician',
            'Dental Aid',
            'Nurse',
            'Medical Technologist',
            'Radiological Technologist',
            'Information Officer',
            'Records Officer',
            'Cashier',
        ];

        foreach ($roles as $role) {
            AccountRole::create([
                'name' => $role,
            ]);
        }
    }
}
