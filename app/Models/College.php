<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    use HasFactory;

    protected $table = 'colleges';

    protected $fillable = [
        'id',
        'name',
        'abbr',
        'is_active',
    ];

    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function degreePrograms()
    {
        return $this->hasMany(DegreeProgram::class);
    }


}
