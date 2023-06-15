<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class FecalysisRecord extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'fecalysis_records';

    protected $fillable = [
        'infirmary_id',
        'fecalysis_id',
        'rqst_physician',
        'medical_technologist',
        'pathologist',
        'or_no',
        'ward',
        'status',
        'is_out_patient',
    ];

    public function fecalysis(): BelongsTo
    {
        return $this->belongsTo(Fecalysis::class, 'fecalysis_id', 'id');
    }

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'infirmary_id', 'infirmary_id');
    }

    public function medicalTechnologist(): BelongsTo
    {
        return $this->belongsTo(User::class, 'medical_technologist', 'id');
    }

    public function pathologist(): BelongsTo
    {
        return $this->belongsTo(User::class, 'pathologist', 'id');
    }

    public function rqstPhysician(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rqst_physician', 'id');
    }


}
