<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_number',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'birthdate',
        'age',
        'sex',
        'blood_type',
        'civil_status',
        'email',
        'phone',
        'home_address',
        'curr_address',
        'degree_program_id',
        'year_level',
        'department_id',
        'client_type_id',
    ];
}
