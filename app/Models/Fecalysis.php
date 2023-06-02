<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fecalysis extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'fecalysis';
    protected $fillable = [
        'id',
        'color',
        'consistency',
        'ova',
        'wbc',
        'rbc',
        'fat_globules',
        'others',
        'remarks',
    ];

    public function fecalysisRecord()
    {
        return $this->hasOne(FecalysisRecord::class, 'fecalysis_id', 'id');
    }
}
