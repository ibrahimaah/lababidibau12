<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Contact;
use App\Models\Category;
use App\Models\SocialMediaLink;
use Illuminate\Http\Request;

class PortfolioVideoController extends Controller
{
    public function index()
    {
        $videos = Video::all();
        $contacts = Contact::find(1);
        $categories = Category::all();
        $social = SocialMediaLink::find(1);
        return view('portfolio-video')->withVideos($videos)->withContacts($contacts)->withCategories($categories)->withSocial($social);
    }
}
