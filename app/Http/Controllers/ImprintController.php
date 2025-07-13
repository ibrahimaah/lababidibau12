<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Category;
use App\Models\Imprint;
use App\Models\SocialMediaLink;
use Illuminate\Http\Request;

class ImprintController extends Controller
{
    public function index()
    {
        $contacts = Contact::find(1);
        $categories = Category::all();
        $social = SocialMediaLink::find(1);
        $imprint = Imprint::find(1);
        return view('imprint')->withContacts($contacts)->withCategories($categories)->withSocial($social)->withImprint($imprint);
    }


    //Imprint Page in admin control panel
    public function index_admin()
    {
        return view('imprint-admin');
    }

    //preview Imprint Page
    public function show()
    {
        $imprint = Imprint::find(1);
        if($imprint)
        {
            return view('imprint-admin-preview')->withImprint($imprint);
        }
        return view('imprint-admin-preview');
    }
   

    public function update(Request $request)
    {
        
        $imprint = Imprint::find(1);
        //if there were not contacts data then add a new row
        if(!$imprint)
        {
            $imprint = new Imprint(); 
        }
        
        $imprint->imprint = $request->imprint ?? '';
        
        if($imprint->save())
        {
            return back()->with('success','Imprint Page Updated Successfully :)');
        }
        else
        {
            return back()->with('faild','Cann\'t update Imprint Page :(');
        }
    }
}
