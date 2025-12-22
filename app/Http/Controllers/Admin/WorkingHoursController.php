<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkingHour;
use Illuminate\Http\Request;

class WorkingHoursController extends Controller
{
    public function update(Request $request)
    {
        $data = [];

        foreach ($request->hours as $day => $times) {
            // If closed checkbox is ticked, make empty array
            if (isset($times['closed'])) {
                $data[$day] = [];
            } elseif (!empty($times['start']) && !empty($times['end'])) {
                $data[$day] = ["{$times['start']}-{$times['end']}"];
            } else {
                $data[$day] = []; // fallback closed
            }
        }

        WorkingHour::updateOrCreate(
            ['id' => 1],
            ['hours' => $data]
        );

        return back()->with('success', 'Working hours updated successfully.');
    }
}
