<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Video extends Model implements HasMedia
{
    use InteractsWithMedia;
    public $timestamps = true;

    protected $fillable = ['title'];
      // For Laravel 8+ (recommended)
      protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime', 
    ];
}
