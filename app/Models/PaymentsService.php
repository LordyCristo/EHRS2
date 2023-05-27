<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentsService extends Model
{
    use HasFactory;

    protected $table = 'payments_service';

    protected $fillable = [
        'payment_id',
        'service_id',
        'fee',
    ];
}
