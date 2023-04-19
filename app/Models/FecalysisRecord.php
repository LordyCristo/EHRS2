<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FecalysisRecord extends Model
{
    use HasFactory;

    protected $table = 'fecalysis_records';
    protected $hidden = [
        'id',
        'client_id',
    ];
}
