<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class XrayImage extends Model
{
    use HasFactory;

    protected $table = 'xray_images';

    protected $fillable = [
        'image'
    ];
}
