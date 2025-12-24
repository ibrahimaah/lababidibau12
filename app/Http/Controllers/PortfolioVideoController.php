<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Contact;
use App\Models\Category;
use App\Models\SocialMediaLink;
use Illuminate\View\View;

class PortfolioVideoController extends Controller
{
    public function index(): View
    {
        $videos     = Video::all();
        $categories = Category::all();
        $contact    = Contact::query()->first();
        $social     = SocialMediaLink::query()->first();

        return view('portfolio-video', compact(
            'videos',
            'categories',
            'contact',
            'social'
        ));
    }
}
