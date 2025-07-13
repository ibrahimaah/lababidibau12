<?php

namespace App\Http\Controllers;

use App\Models\Popup;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PopupController extends Controller
{
    public function index_admin()
    {
        $popup = Popup::find(1);
   
        if($popup)
        {
            return view('popup-admin')->withPopup($popup);
        }

        return view('popup-admin'); 
    }

    public function toggle()
    {

        $popup = Popup::find(1);
        
        $popup->active = $popup->active == 0 ? 1 : 0;

        $popup->save();

        return redirect('admin/popup')->withPopup($popup);
    }

    public function update(Request $request)
    {

        $request->validate([
            'img' => 'required_without_all:desc|image|mimes:jpeg,png,jpg,gif,svg',
            'desc' => 'required_without_all:img'
        ]);

        $popup = Popup::find(1);
        //if there were not popup data then add a new row
        if(!$popup)
        {
            $popup = new Popup(); 
        }
        
        if($request->img)
        {
            //remove the old image 
            if(isset($popup->img))
            {
                if(file_exists(public_path("storage/images/popup/$popup->img")))
                {
                    unlink(public_path("storage/images/popup/$popup->img"));
                }
            }

            $popup_img_name = '_popup'.time().'.'.$request->img->getClientOriginalExtension();

            $request->img->move(public_path('storage/images/popup'), $popup_img_name);
            
            $image = Image::make(public_path('storage/images/popup/'.$popup_img_name))->resize(500, 500);
            $image->save();
            
            $popup->img  = $popup_img_name;
        }
        else
        {
            $popup->img = null;
        }

        if($request->default_popup_img_link)
        {
            $popup->link = '/advertisement';
        }

        $popup->desc = $request->desc;
        
        if($popup->save())
        {
            return back()->with('success','Popup Info Updated Successfully :)');
        }
        else
        {
            return back()->with('faild','Cann\'t update Popup Info :(');
        }
    }

    public function index_popup_admin_img_link()
    {

        $popup = Popup::find(1);

        if($popup)
        {
            return view('popup-admin-img-link')->withPopup($popup); 
        }

        return view('popup-admin-img-link');
    }

    public function update_img_link(Request $request)
    {
        $popup = Popup::find(1);

        if($popup)
        {
            $popup->link = $request->link;
            $popup->save();
            return view('popup-admin-img-link')->withPopup($popup); 
        }

        return view('popup-admin-img-link');
        
    }

    public function reset_img_link(Request $request)
    {
        $popup = Popup::find(1);

        if($popup)
        {
            $popup->link = '/advertisement';
            $popup->save();
            return view('popup-admin-img-link')->withPopup($popup); 
        }

        return view('popup-admin-img-link');
    }
}
