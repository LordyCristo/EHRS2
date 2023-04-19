<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';
    protected $fillable = [
        'name',
        'abbr',
        'college_id',
        'is_active',
    ];

    public function college()
    {
        return $this->belongsTo(College::class);
    }
}
