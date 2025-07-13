<?php

namespace App\Http\Controllers;

use App\Models\Advertisement;
use App\Models\Contact;
use App\Models\Category;

use App\SocialMediaLink;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function index()
    {
        $contacts = Contact::find(1);
        $categories = Category::all();
        $social = SocialMediaLink::find(1);
        $advertisement = Advertisement::find(1);
        return view('advertisement')->withContacts($contacts)->withCategories($categories)->withSocial($social)->withAdvertisement($advertisement);
    }
    
     //Advertisement Page in admin control panel
     public function index_admin()
     {
         return view('advertisement-admin');
     }
 
     //preview Advertisement Page
     public function show()
     {
         $advertisement = Advertisement::find(1);
         if($advertisement)
         {
             return view('advertisement-admin-preview')->withAdvertisement($advertisement);
         }
         return view('advertisement-admin-preview');
     }
    
 
     public function update(Request $request)
     {
         
         $advertisement = Advertisement::find(1);
         //if there were not contacts data then add a new row
         if(!$advertisement)
         {
             $advertisement = new Advertisement(); 
         }
         
         $advertisement->advertisement = $request->advertisement ?? '';
         
         if($advertisement->save())
         {
             return back()->with('success','Advertisement Page Updated Successfully :)');
         }
         else
         {
             return back()->with('faild','Cann\'t update Advertisement Page :(');
         }
     }

}
