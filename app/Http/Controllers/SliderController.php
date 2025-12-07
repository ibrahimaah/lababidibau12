<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Models\Slider;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all(); // or your slider model
        
        // Get slider status using your helper function
        $slider_status = setting('slider_enabled', false);
        
        return view('admin.home.slider.index', compact('sliders', 'slider_status'));
    }
 
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $slider = Slider::create(); // now valid (no required fields)

        $slider->addMediaFromRequest('image')
            ->toMediaCollection('slider-images');

        return back()->with('success', 'Slider Image added successfully :)');
    }

   
    public function destroy($id)
    {
        try {
            $slider = Slider::findOrFail($id);

            // Remove all images from the collection
            $slider->clearMediaCollection('slider-images');

            // Optionally, delete the slider record itself
            $slider->delete();

            return back()->with('success-removed', 'Slider image removed successfully.');
        } catch (Exception $ex) {
            return back()->with('faild-removed', 'Image Can\'t be removed :(');
        }
    }

    public function toggleSlider(Request $request)
    {
        try {
            $status = $request->has('slider_status'); // true when checkbox is checked

            // Check if setting already exists
            $existingSetting = Setting::where('key', 'slider_enabled')->first();

            if ($existingSetting) {
                // Update existing setting
                $existingSetting->update([
                    'value' => $status ? '1' : '0',
                    'updated_at' => now()
                ]);
            } else {
                // Create new setting
                Setting::create([
                    'key' => 'slider_enabled',
                    'value' => $status ? '1' : '0',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            return back()->with('slider_toggle_status', $status ? 'enabled' : 'disabled');
        } catch (\Exception $e) {
            return back()->with('faild', 'Failed to update slider status. Please try again.');
        }
    }
}
