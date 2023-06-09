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

    public function service()
    {
        return $this->belongsTo(Services::class);
    }

    public function clientType()
    {
        return $this->belongsTo(ClientType::class, 'client_type', 'id');
    }

    public function paymentServices()
    {
        return $this->hasMany(PaymentsService::class);
    }
}
