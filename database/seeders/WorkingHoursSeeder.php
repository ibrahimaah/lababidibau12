<?php

namespace Database\Seeders;

use App\Models\WorkingHour;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkingHoursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        WorkingHour::updateOrCreate(
            ['id' => 1],
            [
                'hours' => [
                    'monday'    => ['08:00-17:00'],
                    'tuesday'   => ['08:00-17:00'],
                    'wednesday' => ['08:00-17:00'],
                    'thursday'  => ['08:00-17:00'],
                    'friday'    => ['08:00-17:00'],
                    'saturday'  => ['08:00-15:00'],
                    'sunday'    => [], // closed
                ],
            ]
        );
    }
}
