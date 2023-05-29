<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';
    protected $fillable = [
        'id',
        'name',
        'abbr',
        'college_id',
    ];

    public function college(): BelongsTo
    {
        return $this->belongsTo(College::class);
    }

    public function degreePrograms()
    {
        return $this->hasMany(DegreeProgram::class);
    }
}
