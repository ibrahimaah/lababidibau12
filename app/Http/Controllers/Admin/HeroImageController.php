<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\HeroImage;
use App\Models\Setting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HeroImageController extends Controller
{
    public function index()
    {
        // Get the current hero image
        $heroImage = HeroImage::first();
        
        // Use your helper function to get hero status (default to 'true' string)
        $heroEnabled = setting('hero_enabled', 'true') === 'true';

        return view('admin.home.hero-img.index', [
            'heroImage' => $heroImage,
            'heroStatus' => $heroEnabled
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        ]);

        try {
            DB::beginTransaction();

            // Get or create hero image record
            $heroImage = HeroImage::first();
            
            if (!$heroImage) {
                $heroImage = HeroImage::create(['is_active' => true]);
            }

            // Clear any existing media and add new one
            $heroImage->clearMediaCollection('hero');
            
            $heroImage->addMediaFromRequest('hero_image')
                ->toMediaCollection('hero');

            DB::commit();

            return redirect()->route('admin.hero-image.index')
                ->with('success', 'Hero image updated successfully!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            
            return redirect()->back()
                ->with('error', 'Failed to update hero image: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function toggle()
    {
        try {
            // Get current status using your helper function
            $currentValue = setting('hero_enabled', 'true');
            
            // Toggle the value
            $newValue = ($currentValue === 'true') ? 'false' : 'true';
            
            // Update or create the setting
            Setting::updateOrCreate(
                ['key' => 'hero_enabled'],
                ['value' => $newValue]
            );
            
            $newStatus = $newValue === 'true' ? 'enabled' : 'disabled';

            return redirect()->route('admin.hero-image.index')
                ->with('hero_toggle_status', $newStatus);
                
        } catch (Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to toggle hero image: ' . $e->getMessage());
        }
    }

    public function destroy()
    {
        try {
            $heroImage = HeroImage::first();
            
            if ($heroImage) {
                $heroImage->clearMediaCollection('hero');
                $heroImage->delete();
                
                return redirect()->route('admin.hero-image.index')
                    ->with('success', 'Hero image removed successfully!');
            }
            
            return redirect()->back()
                ->with('error', 'No hero image found to remove.');
                
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to remove hero image: ' . $e->getMessage());
        }
    }
}
