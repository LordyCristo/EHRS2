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
        'collector_id',
        'total_amount',
        'remarks',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function services()
    {
        return $this->hasMany(Services::class);
    }

    public function paidServices()
    {
        return $this->hasMany(PaymentsService::class)->with('service')->select('id', 'payment_id', 'service_id', 'fee');
    }
}
