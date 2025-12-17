<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Laravel\Pennant\Feature;
use App\Enums\PageFeatureEnum;


class PageFeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (PageFeatureEnum::cases() as $feature) {
            Feature::activate($feature->value);
        }
    }
}
