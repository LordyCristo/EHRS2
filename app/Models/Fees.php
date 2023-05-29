<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Fees extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'fees';

    protected $fillable = [
        'id',
        'service_id',
        'client_type',
        'amount',
    ];
}
