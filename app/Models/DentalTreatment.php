<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DentalTreatment extends Model
{
    use HasFactory;
    protected $table = 'dental_treatment_records';
    protected $fillable = [
        'dental_record_id',
        'diagnosis',
        'service_id',
        'tooth_location',
        'operator',
    ];

    public function dentalRecord()
    {
        return $this->belongsTo(DentalRecord::class, 'dental_record_id');
    }

    public function service()
    {
        return $this->belongsTo(Fee::class, 'service_id');
    }
}
