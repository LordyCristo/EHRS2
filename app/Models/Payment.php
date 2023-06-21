<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'payments';

    protected $fillable = [
        'or_no',
        'payor_name',
        'payor_email',
        'payor_mobile',
        'infirmary_id',
        'collector_id',
        'total_amount',
        'remarks',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'infirmary_id', 'infirmary_id');
    }

    public function services()
    {
        return $this->hasMany(Services::class);
    }

    public function paidServices()
    {
        return $this->hasMany(PaymentsService::class, 'payment_id', 'or_no')->with('fees');
    }
}
