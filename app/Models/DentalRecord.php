<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DentalRecord extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'dental_records';
    protected $fillable = [
        'infirmary_id',
        'dentist',
        'or_no',
        'dental_result_id',
        'is_out_patient',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'infirmary_id');
    }

    public function dentist()
    {
        return $this->belongsTo(User::class, 'dentist');
    }

    public function payment()
    {
        return $this->belongsTo(PaymentsService::class, 'or_no');
    }

    public function dentalResult()
    {
        return $this->belongsTo(Dental::class, 'dental_result_id');
    }

    public function treatments()
    {
        return $this->hasMany(DentalTreatment::class, 'dental_record_id');
    }
}
