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
        'religion',
        'nationality',
        'civil_status',
        'phone',
        'email_address',
        'home_address',
        'curr_address',
        'employer',
        'id_number',
        'program_id',
        'year_lvl',
        'client_type_id',
        'is_emergency',
    ];

    function fullName()
    {
        return $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name . ' ' . $this->suffix;
    }

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
        return $this->hasMany(HematologyRecord::class, 'infirmary_id', 'infirmary_id')->with('hematology');
    }

    function urinalysis()
    {
        return $this->hasMany(UrinalysisRecord::class, 'infirmary_id', 'infirmary_id')->with('urinalysis');
    }

    function fecalysis()
    {
        return $this->hasMany(FecalysisRecord::class, 'infirmary_id', 'infirmary_id')->with('fecalysis');
    }

    function xray()
    {
        return $this->hasMany(XrayRequest::class, 'infirmary_id', 'infirmary_id')->with('xray');
    }

    function erDetails()
    {
        return $this->hasOne(ERDetail::class, 'infirmary_id', 'infirmary_id');
    }

    function dental()
    {
        return $this->hasMany(DentalRecord::class, 'infirmary_id', 'infirmary_id')->with('dental');
    }
}
