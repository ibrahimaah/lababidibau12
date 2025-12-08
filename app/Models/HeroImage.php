<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class HeroImage extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['is_active'];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('hero')
            ->singleFile()  // This ensures only one image can be stored
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif']);
    }
}