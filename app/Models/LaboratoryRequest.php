<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaboratoryRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'infirmary_id',
        'physician',
        'urinalysis',
        'stool_exam',
        'cbc',
        'platelet_count',
        'bleeding_clottting_time',
        'hemoglobin',
        'hematocrit',
        'wbc_diff_count',
        'blood_typing',
        'pregnancy_test',
        'afb_straining',
        'is_other',
        'other_value',
        'ward',
        'status',
    ];

    public function patient()
    {
        return $this->belongsTo(Client::class, 'infirmary_id', 'infirmary_id');
    }

    public function physician()
    {
        return $this->belongsTo(User::class, 'physician');
    }
}
