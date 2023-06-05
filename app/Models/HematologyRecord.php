<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HematologyRecord extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'hematology_records';
    protected $fillable = [
        'id',
        'infirmary_id',
        'hematology_id',
        'rqst_physician',
        'medical_technologist',
        'pathologist',
        'or_no',
        'ward',
        'status',
    ];

    public function hematology()
    {
        return $this->belongsTo(Hematology::class, 'hematology_id', 'id');
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
