<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\OpeningHours\OpeningHours;

class WorkingHour extends Model
{
    protected $fillable = ['hours'];

    protected $casts = [
        'hours' => 'array',
    ];

    public function openingHours(): OpeningHours
    {
        return OpeningHours::create($this->hours);
    }
}
