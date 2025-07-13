<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SocialMediaLink;

class SocialMediaLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.SocialMediaLinks.index', [
            'social_media_links' => SocialMediaLink::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.SocialMediaLinks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'link' => 'required',
            'active' => 'required',
            'icon' => 'image|mimes:png|dimensions:width=256,height=256'
        ]);
        
        $social_media_link = new SocialMediaLink();

        $social_media_link->name = $request->name;
        $social_media_link->link = $request->link;
        $social_media_link->active = $request->active;

        if($request->hasFile('icon'))
        { 
            //rename the image
            $iconName = '_social_media_icon'.time().'.'.$request->icon->getClientOriginalExtension();
            //upload the image
            $request->icon->move(public_path('storage/images/social_media_icons'), $iconName);

            $social_media_link->icon = $iconName;
        }

        if($social_media_link->save())
        {
            return back()->with('success','Social Media Link added successfully :)'); 
        }

        return back()->with('faild','Social Media Link added faild :('); 
    }

   

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('admin.SocialMediaLinks.edit', [
            'social_media' => SocialMediaLink::find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        $request->validate([
            'name' => 'required',
            'link' => 'required',
            'active' => 'required',
            'icon' => 'image|mimes:png|dimensions:width=256,height=256'
        ]);
        
        $social_media_link = SocialMediaLink::find($id);

        $social_media_link->name = $request->name;
        $social_media_link->link = $request->link;
        $social_media_link->active = $request->active;
        // dd($request->active);

        if ($request->hasFile('icon')) 
        {
            if($social_media_link->icon)
            {
                if(file_exists(public_path("storage/images/social_media_icons/$social_media_link->icon")))
                {
                    unlink(public_path("storage/images/social_media_icons/$social_media_link->icon"));
                }
            }
            //rename the image
            $iconName = '_social_media_icon'.time().'.'.$request->icon->getClientOriginalExtension();
            //upload the image
            $request->icon->move(public_path('storage/images/social_media_icons'), $iconName);

            $social_media_link->icon = $iconName;
        }

        if($social_media_link->save())
        {
            return back()->with('success','Social Media Link saved successfully :)'); 
        }

        return back()->with('faild','Social Media Link saved faild :('); 

       
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $social_media_link = SocialMediaLink::findOrFail($id);
        if($social_media_link->icon)
        {
            if(file_exists(public_path("storage/images/social_media_icons/$social_media_link->icon")))
            {
                unlink(public_path("storage/images/social_media_icons/$social_media_link->icon"));
            }
        }
        $social_media_link->delete();
        return back()->with('success-removed','Social Media Removed Successfully :)');
        return back()->with('faild-removed','Social Media Can\'t be removed :(');
    }

    public function activate(string $id)
    {
        $social_media_link = SocialMediaLink::find($id);
        $state = SocialMediaLink::find($id)->active;
        $social_media_link->active = ($state == '1') ? '0' : '1';
        $social_media_link->save();
        if($social_media_link->save())
        {
            return back()->with('success','Updated successfully :)'); 
        }

        return back()->with('faild','Update faild :('); 
    }

//    function getSocialMediaLinksToUser()  {
//         return view('partials._header', [
//             'social_media_links' => SocialMediaLink::all()
//         ]);
//    }
}
