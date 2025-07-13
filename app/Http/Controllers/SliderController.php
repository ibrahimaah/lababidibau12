<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Slider::all();
        return view('slider',compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);
    
        if($request->image){
            
            $image = new Slider();
            
            $imageName = $image->img_name.'_image'.time().'.'.$request->image->getClientOriginalExtension();
            //$request->image->storeAs('images',$imageName, 'public');
            $request->image->move(public_path('storage/images/slider'), $imageName);

            $imag = Image::make(public_path('storage/images/slider/'.$imageName))->resize(1000, 500);
            $imag->save();

            $image->img_name = $imageName;
            
            if($image->save())
            {
               return back()->with('success','Slider Image added successfully :)'); 
            }
            
            return back()->with('faild','Slider Image added faild :('); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Slider::findOrFail($id);
        if(file_exists(public_path("storage/images/slider/$image->img_name"))){
            unlink(public_path("storage/images/slider/$image->img_name"));
            $image->delete();
            return back()->with('success-removed','Image Removed Successfully :)');
        } 
    
        return back()->with('faild-removed','Image Can\'t be removed :(');
    }
}
