<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DegreeProgram extends Model
{
    use HasFactory;

    protected $table = 'degree_programs';
    protected $fillable = [
        'name',
        'abbr',
        'major',
        'group',
        'department_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
