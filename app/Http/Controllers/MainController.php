<?php

namespace App\Http\Controllers;

// use App\Models\Map;
use App\Models\User;
use App\Models\About;
use App\Models\Slider;
use App\Models\Contact;
use App\Models\Counter;
use App\Models\Category;
use App\Models\HeroImage;
use App\Models\Popup;
use App\Models\Service;
use App\Models\SocialMediaLink;

class MainController extends Controller
{
    public function index()
    {
        // Get the hero image from database
        $heroImage = HeroImage::first();
        // Check if hero image exists and has media
        $heroMedia = $heroImage ? $heroImage->getFirstMedia('hero') : null;
       
        // Check if hero is enabled using your helper function
        $heroEnabled = setting('hero_enabled', 'true') === 'true';
        
        return view('main', [
            'sliders' => Slider::with('media')->get(),
            'heroMedia' => $heroMedia,
            'heroEnabled' => $heroEnabled,
            'about_us' => About::first(),
            'services' => Service::all(),
            'contacts' => Contact::first(),
            'categories' => Category::all(),
            'counters' => Counter::first(),
            'user' => User::first(),
            'social' => SocialMediaLink::find(1),
            'popup' => Popup::find(1)
        ]);
    }
}
