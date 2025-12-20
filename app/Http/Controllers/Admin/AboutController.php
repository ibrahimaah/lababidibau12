<?php

namespace App\Http\Controllers\Admin;

use App\Enums\PageFeatureEnum;
use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Service;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.home.about.index', [
            'about_us' => About::first(),
            'services' => Service::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $about = About::first();
        $about->title = trim($request->title);
        $about->desc = trim($request->desc);
        
        if ($about->save()) {
            return back()->with('success','Saved successfully :)'); 
        }
        
        return back()->with('faild','Faild :('); 
    }

    public function toggleAbout(Request $request)
    {
        $enabled = $request->boolean('about_status');
    
        PageFeatureEnum::HOME_ABOUT->set($enabled);
    
        return back()->with(
            'about_toggle_status',
            $enabled ? 'enabled' : 'disabled'
        );
    }
}
