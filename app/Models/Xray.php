<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Xray extends Model
{
    use HasFactory;

    protected $table = 'xrays';

    protected $fillable = [
        'id',
        'rqst_id',
        'procedure',
        'impression',
        'radiographic_findings',
        'rad_tech_id',
        'radiologist_id',
    ];

    public function xrayRequest()
    {
        return $this->belongsTo(XrayRequest::class, 'rqst_id', 'id');
    }

    public function radiologist()
    {
        return $this->belongsTo(User::class, 'radiologist', 'id');
    }

    public function radiographer()
    {
        return $this->belongsTo(User::class, 'rad_tech_id', 'id');
    }
}
