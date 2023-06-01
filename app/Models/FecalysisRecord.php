<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FecalysisRecord extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'fecalysis_records';

    protected $fillable = [
        'id',
        'fecalysis_id',
        'infirmary_id',
        'age',
        'sex',
        'ward',
        'or_no',
        'rqst_physician',
        'medical_technologist',
        'pathologist',
        'hospital_no',
        'status',
    ];

    public function fecalysis()
    {
        return $this->belongsTo(Fecalysis::class, 'fecalysis_id', 'id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'infirmary_id', 'infirmary_id');
    }

    public function medicalTechnologist()
    {
        return $this->belongsTo(User::class, 'medical_technologist', 'id');
    }

    public function pathologist()
    {
        return $this->belongsTo(User::class, 'pathologist', 'id');
    }

    public function rqstPhysician()
    {
        return $this->belongsTo(User::class, 'rqst_physician', 'id');
    }


}
