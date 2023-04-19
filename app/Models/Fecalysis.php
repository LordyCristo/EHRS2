<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fecalysis extends Model
{
    use HasFactory;

    protected $table = 'fecalysis';
    protected $fillable = [
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
}
