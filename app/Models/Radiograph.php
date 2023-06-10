<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radiograph extends Model
{
    use HasFactory;

    protected $table = 'radiograph_images';
    protected $fillable = [
        'xray_id',
        'image',
    ];

    public function xray()
    {
        return $this->belongsTo(Xray::class, 'xray_id', 'id');
    }
}
