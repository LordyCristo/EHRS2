<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentsService extends Model
{
    use HasFactory;
    use SoftDeletes;
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


    public function fees()
    {
        return $this->belongsTo(Fees::class, 'service_id','id')->with('service')->with('clientType');
    }

    public function service()
    {
        return $this->belongsTo(Fees::class, 'service_id','service_id');
    }

}
