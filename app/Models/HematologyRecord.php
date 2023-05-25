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
    protected $fillable = [
        'id',
        'client_id',
        'age',
        'sex',
        'ward',
        'or_no',
        'rqst_physician',
        'hospital_no',
    ];
}
