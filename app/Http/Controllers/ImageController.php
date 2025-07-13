<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Exception;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::all();
        $categories = Category::all();
        return view('admin.media.image',compact('images','categories'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'category' => 'required'
        ]);
    
        if($request->image){
            
            $image = new Image();
            $imageName = '_image'.time().'.'.$request->image->getClientOriginalExtension();
            //$request->image->storeAs('images',$imageName, 'public');
            $request->image->move(public_path('storage/images'), $imageName);
            
            
            //Resizing The Image
            // $img = \Intervention\Image\Facades\Image::make(public_path('storage/images/'.$imageName))->resize(800, 600);
            // $img->save();

            $image->name = $imageName;
            $image->category_id = $request->category;
            
            if($image->save())
            {
               return back()->with('success','Image added successfully :)'); 
            }
            
            return back()->with('faild','Image added faild :('); 
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
 
        $image = Image::findOrFail($id);
        if(file_exists(public_path("storage/images/$image->name"))){
            unlink(public_path("storage/images/$image->name"));
            $image->delete();
            return back()->with('success-removed','Image Removed Successfully :)');
        } 
    
        return back()->with('faild-removed','Image Can\'t be removed :(');

        
    }
}
