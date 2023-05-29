<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentsService extends Model
{
    use HasFactory;

    protected $table = 'payments_service';

    protected $fillable = [
        'id',
        'payment_id',
        'service_id',
        'fee',
    ];

    public function payments()
    {
        return $this->belongsTo(Payment::class);
    }

    public function services()
    {
        return $this->belongsTo(Service::class);
    }
}
