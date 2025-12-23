<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Image extends Model implements HasMedia
{
    use InteractsWithMedia;

    // protected $fillable = ['name','category_id'];
    protected $fillable = ['category_id'];

    public $timestamps = false;

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
