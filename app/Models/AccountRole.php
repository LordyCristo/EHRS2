<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountRole extends Model
{
    use HasFactory;

    protected $table = 'account_roles';

    protected $fillable = [
       'name',
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
