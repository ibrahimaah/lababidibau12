<?php

namespace App\Http\Controllers\Admin;

use App\Models\TinymceImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TinymceImageController extends Controller
{
    public function index()
    {
        $tinymce_imgs = TinymceImage::all();
        if($tinymce_imgs)
        {
            return view('admin.tinymce-img')->with('tinymce_imgs',$tinymce_imgs);
        }
        return view('admin.tinymce-img');
    }

    public function store(Request $request)
    {
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $imageName = '_tinymce'.time().'.'.$request->img->getClientOriginalExtension();

        $request->img->move(public_path('storage/images/tinymce'), $imageName);
        
        //Resizing The Image
        $img = \Intervention\Image\Facades\Image::make(public_path('storage/images/tinymce/'.$imageName))->resize(400, 400);
        $img->save();


        $tinymce_img = new TinymceImage();
        $tinymce_img->img = $imageName;
        if($tinymce_img->save())
        {
            return back()->with('success','Image added successfully :)'); 
        }
        
        return back()->with('faild','Image added faild :('); 
    }

    public function destroy($id)
    {
 
        $tinymce_img = TinymceImage::findOrFail($id);
        if(file_exists(public_path("storage/images/tinymce/$tinymce_img->img"))){
            unlink(public_path("storage/images/tinymce/$tinymce_img->img"));
            $tinymce_img->delete();
            return back()->with('success-removed','Image Removed Successfully :)');
        } 
    
        return back()->with('faild-removed','Image Can\'t be removed :(');
    }

}
