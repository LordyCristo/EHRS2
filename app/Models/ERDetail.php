<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ERDetail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'er_details';
    protected $fillable =[
        'infirmary_id',
        'date_admitted',
        'time_admitted',
        'brought_by',
        'arrival_condition',
        'temperature',
        'temperature_location',
        'weight',
        'pulse_rate',
        'blood_pressure',
        'cardiac_rate',
        'respiratory_rate',
        'oxygen_saturation',
        'chief_complaint',
        'allergies',
        'physical_exam',
        'current_medications',
        'treatment',
        'nurse_notes',
        'diagnosis',
        'disposition',
        'date_disposition',
        'time_disposition',
        'discharge_condition',
        'attending_nurse',
        'attending_physician',
    ];

    public function client(){
        return $this->belongsTo(Client::class,'infirmary_id','infirmary_id');
    }
}
