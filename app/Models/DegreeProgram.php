<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DegreeProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'abbreviation',
        'major',
        'department_id',
        'is_active',
    ];
}
