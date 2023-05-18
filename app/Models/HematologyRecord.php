<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HematologyRecord extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'hematology_records';
    protected $hidden = [
        'id',
        'client_id',
    ];
}
