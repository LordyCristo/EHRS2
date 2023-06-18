<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalCertificate extends Model
{
    use HasFactory;

    protected $table = 'medical_certificates';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cbc',
        'urinalysis',
        'fecalysis',
        'drug_test',
        'chest_xray',
        'psychological',
        'neuropsychiatric',
        'nolabneeded',
        'is_fit',
        'purpose',
        'purpose_sport',
        'specific_purpose',
        'remarks',
        'physician_id',
        'infirmary_id',
    ];
}
