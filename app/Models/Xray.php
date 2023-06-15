<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Xray extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'xrays';

    protected $fillable = [
        'id',
        'rqst_id',
        'procedure',
        'impression',
        'radiographic_findings',
        'rad_tech_id',
        'radiologist_id',
        'is_out_patient',
    ];

    public function xrayRequest()
    {
        return $this->belongsTo(XrayRequest::class, 'rqst_id', 'id');
    }

    public function radiologist()
    {
        return $this->belongsTo(User::class, 'radiologist_id', 'id');
    }

    public function radiographer()
    {
        return $this->belongsTo(User::class, 'rad_tech_id', 'id');
    }

    public function radiograph()
    {
        return $this->hasOne(Radiograph::class, 'xray_id', 'id');
    }
}
