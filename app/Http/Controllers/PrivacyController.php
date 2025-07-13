<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use App\Models\Privacy;
use App\Models\SocialMediaLink;
use Illuminate\Http\Request;

class PrivacyController extends Controller
{
    public function index()
    {
        $contacts = Contact::find(1);
        $categories = Category::all();
        $social = SocialMediaLink::find(1);
        $privacy = Privacy::find(1);
        return view('privacy_policy')->withContacts($contacts)->withCategories($categories)->withSocial($social)->withPrivacy($privacy);
    }
    
     //Privacy Policy Page in admin control panel
     public function index_admin()
     {
         return view('privacy-admin');
     }
 
     //preview Privacy Policy Page
     public function show()
     {
         $privacy = Privacy::find(1);
         if($privacy)
         {
             return view('privacy-admin-preview')->withPrivacy($privacy);
         }
         return view('privacy-admin-preview');
     }
    
 
     public function update(Request $request)
     {
         
         $privacy = Privacy::find(1);
         //if there were not contacts data then add a new row
         if(!$privacy)
         {
             $privacy = new Privacy(); 
         }
         
         $privacy->privacy = $request->privacy ?? '';
         
         if($privacy->save())
         {
             return back()->with('success','Privacy Policy Page Updated Successfully :)');
         }
         else
         {
             return back()->with('faild','Cann\'t update Privacy Policy Page :(');
         }
     }
}
