<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'birthdate',
        'age',
        'sex',
        'role_id',
        'specialization',
        'curr_position',
        'license_no',
        'telephone',
        'mobile',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(AccountType::class, 'role_id');
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . $this->middle_name?$this->middle_name[0].'. ':' ' . $this->last_name;
    }
}
