<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Outpatient extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'outpatients';

    protected $fillable = [
        'client_type_id',
        'infirmary_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'age',
        'gender',
        'religion',
        'civil_status',
        'office_dept',
        'program_id',
        'year_lvl',
        'residence_address',
        'campus_address',
        'patient_no',
        'guardian_name',
        'guardian_relation',
        'guardian_no',
        'guardian_office_dept',
    ];
}
