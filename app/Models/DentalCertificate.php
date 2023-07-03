<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DentalCertificate extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'dental_certificates';
    protected $fillable = [
        'dentist',
        'infirmary_id',
        'or_no',
        'diagnosis',
        'num_days',
        'admission_date',
        'discharge_date',
        'remarks',
    ];

    public function dentist()
    {
        return $this->belongsTo(User::class, 'dentist', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'infirmary_id', 'infirmary_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'or_no', 'or_no');
    }
}
