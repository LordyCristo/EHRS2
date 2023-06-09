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
//        Services::factory()->create([
//            'name' => 'Urinalysis',
//            'description' => 'Urine examination',
//            'schedule' => 'M-F 8am-5pm',
//            'section_name' => 'Laboratory Section',
//            'room_no' => 'Room-1',
//        ]);
//
//        Services::factory()->create([
//            'name' => 'Fecalysis',
//            'description' => 'Feces and stool examination',
//            'schedule' => 'M-F 8am-5pm',
//            'section_name' => 'Laboratory Section',
//            'room_no' => 'Room-1',
//        ]);
//
//        Services::factory()->create([
//            'name' => 'CBC',
//            'description' => 'Blood examination',
//            'schedule' => 'M-F 8am-5pm',
//            'section_name' => 'Laboratory Section',
//            'room_no' => 'Room-1',
//        ]);
//
//        Services::factory()->create([
//            'name' => 'Physical Examination',
//            'description' => 'This is where physical examinations are done',
//            'schedule' => 'M-F 8am-5pm',
//            'section_name' => 'Outpatient Section',
//            'room_no' => 'Room-2',
//        ]);
//
//        Services::factory()->create([
//            'name' => 'Radiology',
//            'description' => 'This is where X-ray are done',
//            'schedule' => 'M-F 8am-5pm',
//            'section_name' => 'In/Out-patient Section',
//            'room_no' => 'Room-3',
//        ]);
        Services::factory()->create([
            'name' => 'Tooth Extractions Normal Procedure',
            'description' => 'Normal Procedure',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Dental  Section',
            'room_no' => 'Room-1',
        ]);
        Services::factory()->create([
            'name' => 'Tooth Extractions By Bur',
            'description' => 'By Bur',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Dental  Section',
            'room_no' => 'Room-1',
        ]);
        Services::factory()->create([
            'name' => 'Tooth Extractions With Suture',
            'description' => 'With Suture',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Dental  Section',
            'room_no' => 'Room-1',
        ]);
        Services::factory()->create([
            'name' => 'Complicated Tooth Extraction: Impaction',
            'description' => 'Complicated Tooth Extraction: Masioangular Impaction',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Dental  Section',
            'room_no' => 'Room-1',
        ]);
        Services::factory()->create([
            'name' => 'Restorative Fillings: Class I to V',
            'description' => 'Restorative Fillings: Light Cure Composite',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Dental  Section',
            'room_no' => 'Room-1',
        ]);
        Services::factory()->create([
            'name' => 'Closure of Diastema Cosmetic Dentistry',
            'description' => 'Closure of Diastema Cosmetic Dentistry',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Dental  Section',
            'room_no' => 'Room-1',
        ]);
        Services::factory()->create([
            'name' => 'ORAL Prophylaxis: Supra Gingival Calculus',
            'description' => 'ORAL Prophylaxis: Supra Gingival Calculus',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Dental  Section',
            'room_no' => 'Room-1',
        ]);
        Services::factory()->create([
            'name' => 'ORAL Prophylaxis: Sub Gingival Calculus( gingivitis)',
            'description' => 'ORAL Prophylaxis: Sub Gingival Calculus( gingivitis)',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Dental  Section',
            'room_no' => 'Room-1',
        ]);
        Services::factory()->create([
            'name' => 'ORAL Prophylaxis: Treatment of Periodontitis and Quadrants',
            'description' => 'ORAL Prophylaxis: Treatment of Periodontitis and Quadrants',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Dental  Section',
            'room_no' => 'Room-1',
        ]);
        //Radiology
        Services::factory()->create([
            'name' => 'X-ray: ABDOMEN AP UPRIGHT AND SUPINE (ADULTS)',
            'description' => 'X-ray: ABDOMEN AP UPRIGHT AND SUPINE (ADULTS)',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology  Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: ANKLE AP/LATERAL/OBLIQUE',
            'description' => 'X-ray: ANKLE AP/LATERAL/OBLIQUE',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology  Section',
            'room_no' => 'Room-2',
        ]);
        Services::factory()->create([
            'name' => 'X-ray: ARM AP/LATERAL',
            'description' => 'X-ray: ARM AP/LATERAL',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: CERVICAL SPINE APL',
            'description' => 'Cervical Spine APL',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: CHEST PA',
            'description' => 'Chest PA',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: CHEST AP/LATERAL',
            'description' => 'X-ray: CHEST AP/LATERAL',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: CHEST APICO-LORDOTIC',
            'description' => 'X-ray: CHEST APICO-LORDOTIC',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: CHEST BUCKY',
            'description' => 'X-ray: CHEST BUCKY',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: CLAVICLE AP VIEW ONLY',
            'description' => 'X-ray: Clavicle AP View Only',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: ELBOW AP/LATERAL VIEW',
            'description' => 'X-ray: Elbow AP/Lateral View',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: FEMUR/ THIGH AP/LATERAL',
            'description' => 'X-ray: Femur/Thigh AP/Lateral',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: FOOT AP/LATERAL/OBLIQUE',
            'description' => 'X-ray: Foot AP/Lateral/Oblique',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: FOREARM AP/LATERAL',
            'description' => 'X-ray: Forearm AP/Lateral',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: KNEE AP/LATERAL',
            'description' => 'X-ray: Knee AP/Lateral',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: LEG AP/LATERAL',
            'description' => 'X-ray: Leg AP/Lateral',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: LUMBO-SACRAL SPINE AP/LATERAL',
            'description' => 'X-ray: Lumbo-Sacral Spine AP/Lateral',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: PARANASAL SINUSES (PNS) 3 VIEWS',
            'description' => 'X-ray: Paranasal Sinuses (PNS) 3 Views',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: PELVIS AP VIEW ONLY',
            'description' => 'X-ray: Pelvis AP View Only',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: BOTH SHOULDER AP NEUTRAL VIEW',
            'description' => 'X-ray: Both Shoulder AP Neutral View',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: SHOULDER AP W/ INTERNAL OR EXTERNAL ROTATION',
            'description' => 'X-ray: Shoulder AP with Internal or External Rotation',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: SKULL AP/LATERAL',
            'description' => 'X-ray: Skull AP/Lateral',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: THORACO-LUMBAR SPINE AP/LATERAL',
            'description' => 'X-ray: Thoraco-Lumbar Spine AP/Lateral',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'X-ray: WRIST AP/LATERAL',
            'description' => 'X-ray: Wrist AP/Lateral',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => "X-ray: WATER'S VIEW",
            'description' => "X-ray: Water's View",
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Radiology Section',
            'room_no' => 'Room-2',
        ]);

        Services::factory()->create([
            'name' => 'Laboratory: CBC',
            'description' => 'Complete Blood Count (CBC) measures various components of blood and can help diagnose conditions and diseases.',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Laboratory Section',
            'room_no' => 'Room-3',
        ]);

        Services::factory()->create([
            'name' => 'Laboratory: Hematocrit manual',
            'description' => 'Hematocrit Manual is a blood test that measures the percentage of red blood cells in the total volume of blood.',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Laboratory Section',
            'room_no' => 'Room-3',
        ]);

        Services::factory()->create([
            'name' => 'Laboratory: Blood typing',
            'description' => 'Blood Typing determines a person\'s blood type (A, B, AB, or O) and Rh factor (positive or negative).',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Laboratory Section',
            'room_no' => 'Room-3',
        ]);

        Services::factory()->create([
            'name' => 'Laboratory: RH Typing',
            'description' => 'RH Typing determines the presence or absence of the Rh factor in blood (positive or negative).',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Laboratory Section',
            'room_no' => 'Room-3',
        ]);

        Services::factory()->create([
            'name' => 'Laboratory: Urinalysis',
            'description' => 'Urinalysis is a test that examines the urine for various components and can help diagnose urinary tract infections, kidney problems, and other conditions.',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Laboratory Section',
            'room_no' => 'Room-3',
        ]);

        Services::factory()->create([
            'name' => 'Laboratory: Capillary Blood Sugar',
            'description' => 'Capillary Blood Sugar is a test that measures the amount of glucose (sugar) in the blood and can help diagnose and manage diabetes.',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Laboratory Section',
            'room_no' => 'Room-3',
        ]);

        Services::factory()->create([
            'name' => 'Laboratory: Fecalysis',
            'description' => 'Fecalysis is a test that examines the stool for various components and can help diagnose gastrointestinal disorders and infections.',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Laboratory Section',
            'room_no' => 'Room-3',
        ]);

        Services::factory()->create([
            'name' => 'Laboratory: Pregnancy Test',
            'description' => 'Pregnancy Test determines the presence or absence of the pregnancy hormone (hCG) in urine or blood, indicating pregnancy.',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Laboratory Section',
            'room_no' => 'Room-3',
        ]);

        Services::factory()->create([
            'name' => 'Records: Medical Certification',
            'description' => 'Medical Certification is a document that certifies a person\'s medical condition and can be used for various purposes (e.g. employment, travel, etc.).',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'Records Section',
            'room_no' => 'Room-4',
        ]);

        // Suturing
        Services::factory()->create([
            'name' => 'Minor Surgery: Suturing (Small)',
            'description' => '< 5 CM',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

        Services::factory()->create([
            'name' => 'Minor Surgery: Suturing (Medium)',
            'description' => '5<10 CM',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

        Services::factory()->create([
            'name' => 'Minor Surgery: Suturing (Large)',
            'description' => '10CM OR MULTIPLE',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

        // Wound Dressing
        Services::factory()->create([
            'name' => 'Minor Surgery: Wound Dressing (Small)',
            'description' => 'Supplies Only',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

        Services::factory()->create([
            'name' => 'Minor Surgery: Wound Dressing (Medium)',
            'description' => 'Supplies Only',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

        Services::factory()->create([
            'name' => 'Minor Surgery: Wound Dressing (Large)',
            'description' => 'Supplies Only',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

        // Removal of Sutures
        Services::factory()->create([
            'name' => 'Minor Surgery: Removal of Sutures',
            'description' => 'Supplies Only',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

// Referral Injection
        Services::factory()->create([
            'name' => 'Minor Surgery: Referral Injection',
            'description' => 'Supplies Only',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

// I and D
        Services::factory()->create([
            'name' => 'Minor Surgery: I and D',
            'description' => '',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

// Debridement Dressing (D&D)
        Services::factory()->create([
            'name' => 'Minor Surgery: Debridement Dressing (D&D)',
            'description' => '',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

// Re-insertion of IV
        Services::factory()->create([
            'name' => 'Minor Surgery: Re-insertion of IV',
            'description' => '',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

// Catheterization
        Services::factory()->create([
            'name' => 'Minor Surgery: Catheterization',
            'description' => 'Supplies Only',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

// NGT
        Services::factory()->create([
            'name' => 'Minor Surgery: NGT',
            'description' => 'Supplies Only',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

// Excision
        Services::factory()->create([
            'name' => 'Minor Surgery: Excision (Small)',
            'description' => 'Supplies Only',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

        Services::factory()->create([
            'name' => 'Minor Surgery: Excision (Medium)',
            'description' => 'Supplies Only',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

        Services::factory()->create([
            'name' => 'Minor Surgery: Excision (Large)',
            'description' => 'Supplies Only',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

// Circumcision
        Services::factory()->create([
            'name' => 'Minor Surgery: Circumcision',
            'description' => 'Supplies Only',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

// Removal of Foreign Body
        Services::factory()->create([
            'name' => 'Minor Surgery: Removal of Foreign Body',
            'description' => '',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

// Prenatal Fee
        Services::factory()->create([
            'name' => 'Minor Surgery: Prenatal Fee',
            'description' => '',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);
// Fee for lost OPD No.
        Services::factory()->create([
            'name' => 'Minor Surgery: Fee for lost OPD No.',
            'description' => '',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

// Consultation fee after office hours
        Services::factory()->create([
            'name' => 'Minor Surgery: Consultation fee after office hours',
            'description' => '',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

// ER FEE
        Services::factory()->create([
            'name' => 'Minor Surgery: ER FEE',
            'description' => '',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

// Nebulization Fee: with meds
        Services::factory()->create([
            'name' => 'Minor Surgery: Nebulization Fee: with meds',
            'description' => '',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

// Nebulization Fee: without meds
        Services::factory()->create([
            'name' => 'Minor Surgery: Nebulization Fee: without meds',
            'description' => '',
            'schedule' => 'M-F 8am-5pm',
            'section_name' => 'ER Section',
            'room_no' => 'Room-4',
        ]);

//        //AMBULANCE FEE
//        Services::factory()->create([
//            'name' => 'Ambulance: WLPH - Baybay City',
//            'description' => '',
//            'schedule' => 'M-F 8am-5pm',
//            'section_name' => 'Ambulance Section',
//            'room_no' => 'Room-5',
//        ]);
//
//        Services::factory()->create([
//            'name' => 'Ambulance: OSPA - Ormoc City',
//            'description' => '',
//            'schedule' => 'M-F 8am-5pm',
//            'section_name' => 'Ambulance Section',
//            'room_no' => 'Room-5',
//        ]);
//
//        Services::factory()->create([
//            'name' => 'Ambulance: EVRMC - Tacloban City',
//            'description' => '',
//            'schedule' => 'M-F 8am-5pm',
//            'section_name' => 'Ambulance Section',
//            'room_no' => 'Room-5',
//        ]);
//
//        Services::factory()->create([
//            'name' => 'Ambulance: Hilongos Leyte',
//            'description' => '',
//            'schedule' => 'M-F 8am-5pm',
//            'section_name' => 'Ambulance Section',
//            'room_no' => 'Room-5',
//        ]);
//
//        Services::factory()->create([
//            'name' => 'Ambulance: Maasin City',
//            'description' => '',
//            'schedule' => 'M-F 8am-5pm',
//            'section_name' => 'Ambulance Section',
//            'room_no' => 'Room-5',
//        ]);
    }
}
