<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Contact;
use App\Models\Category;
use App\Models\SocialMediaLink;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $contacts = Contact::find(1);
        $categories = Category::all();
        $social = SocialMediaLink::find(1);
        $jobs = Job::all();
        return view('job')->withContacts($contacts)->withCategories($categories)->withSocial($social)->withJobs($jobs);
    }
}
