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
            'Admin', // 1 Admin, MorepageACM
            'Laboratory', // 2 LaboratoryACM
            'Cashier', // 3 FinanceACM
            'Radiology', // 4 RadiologyACM
            'Dental', // 5 DentalACM
            'ER', // 6 EmergencyroomACM
            'Pharmacy', // 7 Pharmacy
            'IO', // 8 InformationOfficerACM
        ];

        foreach ($roles as $role) {
            AccountRole::create([
                'name' => $role,
            ]);
        }
    }
}
