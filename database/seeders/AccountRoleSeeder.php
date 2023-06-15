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
            'admin', // 1 Admin
            'laboratory', // 2 LaboratoryACM
            'cashier', // 3 FinanceACM
            'radiology', // 4 RadiologyACM
            'dental', // 5 DentalACM
            'er', // 6 EmergencyroomACM
            'io', // 7 InformationOfficerACM
        ];

        foreach ($roles as $role) {
            AccountRole::create([
                'name' => $role,
            ]);
        }
    }
}
