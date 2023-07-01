<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhysicalExamAttachment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'physical_exam_attachment';

    protected $fillable = [
        'physical_exam_id',
        'image',
    ];

    public function physicalExam()
    {
        return $this->belongsTo(PhysicalExam::class, 'physical_exam_id', 'id');
    }
}
