<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hematology extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'hematology';
    protected $fillable = [
        'id',
        'hemoglobin',
        'hematocrit',
        'wbc',
        'rbc',
        'platelet_count',
        'segmenters',
        'lymphocyte',
        'monocyte',
        'blood_type',
        'diagnosis',
        'remarks',
        'status',
    ];

    public function hematologyRecord()
    {
        return $this->hasOne(HematologyRecord::class, 'id', 'id');
    }
}
