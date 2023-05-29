<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'payments';

    protected $fillable = [
        'id',
        'or_no',
        'payor_name',
        'payor_email',
        'payor_mobile',
        'client_id',
        'service_id',
        'collector_id',
        'amount',
        'remarks',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function paidServices()
    {
        return $this->belongsTo(PaymentsService::class);
    }
}
