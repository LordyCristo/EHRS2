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

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function fee()
    {
        return $this->belongsTo(Fees::class);
    }

    public function service()
    {
        return $this->belongsTo(Fees::class)->with('service');
    }

}
