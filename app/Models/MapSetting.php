<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MapSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'embed_url',
        'height',
        'is_active',
        'location_name',
        'address'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'height' => 'integer'
    ];
}