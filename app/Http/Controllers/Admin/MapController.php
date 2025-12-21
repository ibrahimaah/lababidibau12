<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MapSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MapController extends Controller
{
    public function index()
    {
        // Get or create map settings
        $mapSetting = MapSetting::first();
        
        if (!$mapSetting) {
            $mapSetting = MapSetting::create([
                'embed_url' => 'https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d2000.50685128268!2d6.956550975592145!3d50.62490387478869!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNTDCsDM3JzI5LjYiTiA2wrA1NyczMi45IkU!5e1!3m2!1sen!2s!4v1765740969123!5m2!1sen!2s',
                'height' => 270,
                'is_active' => true,
                // 'location_name' => 'Default Location',
                // 'address' => 'Cologne, Germany'
            ]);
        }

        return view('admin.home.map.index', compact('mapSetting'));
    }

    public function update(Request $request, MapSetting $mapSetting)
    {
        $validated = $request->validate([
            'embed_url' => 'required|string',
            'height' => 'required|integer|min:200|max:500',
            'is_active' => 'boolean',
            // 'location_name' => 'nullable|string|max:255',
            // 'address' => 'nullable|string|max:500'
        ]);

        $mapSetting->update($validated);

        return redirect()->route('admin.map.index')
            ->with('success', 'Map settings updated successfully!');
    }

    public function toggle(MapSetting $mapSetting)
    {
        $mapSetting->update([
            'is_active' => !$mapSetting->is_active
        ]);

        $status = $mapSetting->is_active ? 'enabled' : 'disabled';
        
        return redirect()->route('admin.map.index')
            ->with('toggle_status', $status)
            ->with('success', "Map has been $status");
    }
}