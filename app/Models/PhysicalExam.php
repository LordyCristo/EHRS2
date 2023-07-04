<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhysicalExam extends Model
{
    use HasFactory;

    protected $table = 'physical_exams';

    protected $fillable = [
        'infirmary_id',
        //student
        'examiner',
        'weight',
        'height',
        'blood_pressure',
        'pulse',
        'prev_illns_oprtn',
        'immnztn_vccntn',
        'head_neck',
        'scalp_face',
        'neck_thyroid',
        'lymph_glands',
        'vision_with_glasses',
        'vision_without_glasses',
        'mouth_throat_tonsils',
        'mouth_throat_teeth',
        'heart',
        'lung',
        'abdomen_tenderness',
        'abdomen_mass',
        'abdomen_scars',
        'abdomen_rep_organ',
        'spine_extrts_deformities',
        'spine_extrts_varicosities',
        'spine_extrts_feet',
        'skin_diseases',
        'radiography',
        'laboratory',
        //outpatient
        'history',
        'treatment',
        //er

        'remarks',
        'form_type',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'infirmary_id', 'infirmary_id');
    }

    public function attachments()
    {
        return $this->hasMany(PhysicalExamAttachment::class, 'physical_exam_id', 'id');
    }
}
