<?php

namespace Database\Seeders;

use App\Models\Services;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Services::factory()->create([
            'name' => 'Annual Medical Examination for Staff and Students',
            'description' => 'Yearly medical examination for staff and students',
            'schedule' => 'M-F 8am-4pm (Except Holidays)',
            'section_name' => 'OPD',
            'room_no' => null,
        ]);

        Services::factory()->create([
            'name' => 'Minor Surgery',
            'description' => 'This is where medical records are kept',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Records Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'Health Education Service',
            'description' => 'This is where X-Rays are taken',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'X-Ray Section',
            'room_no' => 'Room-3',
        ]);

        Services::factory()->create([
            'name' => 'Pre-natal consultation',
            'description' => 'This is where laboratory tests are done',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Laboratory Section',
            'room_no' => 'Room-4',
        ]);

        Services::factory()->create([
            'name' => 'Medico-legal Certificate',
            'description' => 'This is where medicines are dispensed',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Pharmacy Section',
            'room_no' => 'Room-5',
        ]);

        Services::factory()->create([
            'name' => 'Physical Examination',
            'description' => 'This is where outpatient consultations are done',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Outpatient Section',
            'room_no' => 'Room-6',
        ]);

        Services::factory()->create([
            'name' => 'Chest X-Ray',
            'description' => 'This is where inpatient consultations are done',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Inpatient Section',
            'room_no' => 'Room-7',
        ]);

        Services::factory()->create([
            'name' => 'CBC',
            'description' => 'This is where billing is done',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Billing Section',
            'room_no' => 'Room-8',
        ]);

        Services::factory()->create([
            'name' => 'Urinalysis',
            'description' => 'This is where billing is done',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Billing Section',
            'room_no' => 'Room-8',
        ]);

        Services::factory()->create([
            'name' => 'Fecalysis',
            'description' => 'This is where billing is done',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Billing Section',
            'room_no' => 'Room-8',
        ]);

        Services::factory()->create([
            'name' => 'Blood Typing',
            'description' => 'This is where billing is done',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Billing Section',
            'room_no' => 'Room-8',
        ]);
    }
}
