<?php

namespace Database\Seeders;

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
            'Admin',
            'Doctor',
            'Nurse',
            'Laboratory',
            'Pharmacy',
            'Cashier',
            'Receptionist',
        ];

        foreach ($roles as $role) {
            \App\Models\AccountRole::create([
                'name' => $role,
            ]);
        }
    }
}
