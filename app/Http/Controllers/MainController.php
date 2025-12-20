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
        return view('main', [
            'contacts' => Contact::first(),
            'categories' => Category::all(),
            'counters' => Counter::first(),
            'user' => User::first(),
            'social' => SocialMediaLink::find(1),
            'popup' => Popup::find(1)
        ]);
    }
}
