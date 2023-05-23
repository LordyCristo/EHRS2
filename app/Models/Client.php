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
        'first_name',
        'middle_name',
        'last_name',
        'suffix',
        'birthdate',
        'age',
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
        return $this->belongsTo(DegreeProgram::class);
    }

    function clientType()
    {
        return $this->belongsTo(ClientType::class);
    }


    function fecalysisRecord()
    {
        return $this->hasMany(HematologyRecord::class);
    }

    function degreeProgram()
    {
        return $this->belongsTo(DegreeProgram::class);
    }

    static function getTableName(){
        // return the table name
        return with(new static)->getTable();
    }
}
