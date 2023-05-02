<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientType extends Model
{
    use HasFactory;

    protected $table = 'client_types';

    protected $fillable = [
        'label',
    ];

    function clients()
    {
        return $this->belongsTo(Client::class);
    }

    
}
