<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'clients';
    protected $fillable = [
        'id',
        'infirmary_id',
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'birthdate',
        'age',
        'sex',
        'civil_status',
        'phone',
        'email_address',
        'home_address',
        'curr_address',
        'id_number',
        'program_id',
        'year_lvl',
        'client_type_id',
    ];

    function program()
    {
        return $this->hasOne(DegreeProgram::class);
    }

    function clientType()
    {
        return $this->hasOne(ClientType::class);
    }


    function hematology()
    {
        return $this->hasMany(HematologyRecord::class);
    }
}
