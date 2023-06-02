<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Urinalysis extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'urinalysis';
    protected $fillable = [
        'id',
        'color',
        'clarity',
        'ph',
        'specific_gravity',
        'albumin',
        'glucose',
        'blood',
        'leukocytes',
        'nitrite',
        'urobilinogen',
        'ketones',
        'wbc',
        'rbc',
        'epithelial_cells',
        'bacteria',
        'amorphous_urates',
        'amorphous_phosphates',
        'mucous_threads',
        'crystals',
        'cast',
        'remarks',
    ];

    public function urinalysisRecord()
    {
        return $this->hasOne(UrinalysisRecord::class, 'urinalysis_id', 'id');
    }
}
