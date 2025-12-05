<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreImageRequest;
use Exception;
use App\Models\Category;
use App\Services\ImageService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class ImageController extends Controller
{
    public function __construct(protected ImageService $imageService) {}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $images = Image::with('category')->orderByDesc('id')->get();
        $categories = Category::orderBy('name')->get();
    
        return view('admin.media.image', [
            'images'     => $images,
            'categories' => $categories,
        ]);
    }
    


    public function store(StoreImageRequest $request)
    { 

        $res_upload = $this->imageService->upload($request->validated());

        if($res_upload['code'] == 0)
        {
            return back()->with('error', $res_upload['msg']);
        }
        return back()->with('success', 'Image added successfully :)');
    }


    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
    //         'category' => 'required'
    //     ]);
    
    //     if($request->image){
            
    //         $image = new Image();
    //         $imageName = '_image'.time().'.'.$request->image->getClientOriginalExtension();
    //         //$request->image->storeAs('images',$imageName, 'public');
    //         $request->image->move(public_path('storage/images'), $imageName);
            
            
    //         //Resizing The Image
    //         // $img = \Intervention\Image\Facades\Image::make(public_path('storage/images/'.$imageName))->resize(800, 600);
    //         // $img->save();

    //         $image->name = $imageName;
    //         $image->category_id = $request->category;
            
    //         if($image->save())
    //         {
    //            return back()->with('success','Image added successfully :)'); 
    //         }
            
    //         return back()->with('faild','Image added faild :('); 
    //     }

    // }

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


    public function destroy($id)
    {
        $res_remove = $this->imageService->remove(['id' => $id]);
        
        return $res_remove['code']
            ? back()->with('success', 'Image removed')
            : back()->with('faild', $res_remove['msg']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\image  $image
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
 
    //     $image = Image::findOrFail($id);
    //     if(file_exists(public_path("storage/images/$image->name"))){
    //         unlink(public_path("storage/images/$image->name"));
    //         $image->delete();
    //         return back()->with('success-removed','Image Removed Successfully :)');
    //     } 
    
    //     return back()->with('faild-removed','Image Can\'t be removed :(');

        
    // }
}
