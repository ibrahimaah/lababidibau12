<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
  
    public function index()
    {
        $categories = Category::all();
        return view('admin.home.categories.index',compact('categories'));
    }

   
    public function create()
    {
        return view('admin.home.categories.create');
    }
    
    public function edit($id)
    {
        return view('admin.home.categories.edit')->with('category',Category::findOrFail($id));
    }

    public function store(Request $request)
    {

        $request->validate([
            'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'name' => 'required'
        ]);

        
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        
        $iconName = '_icon'.time().'.'.$request->icon->getClientOriginalExtension();

        $request->icon->move(public_path('storage/images/icons'), $iconName);
        
        $image = Image::make(public_path('storage/images/icons/'.$iconName))->resize(500, 320);
        $image->save();
        
        $category->icon = $iconName;

        // dd($category);
        if($category->save())
        {
            return back()->with('success','A New Category added successfuly :)');
        }
        else
        {
            return back()->with('faild','Cann\'t add a new Category :(');
        } 
    }

    
    public function update(Request $request,$id)
    {

        $request->validate([
            'icon' => 'image|mimes:jpeg,png,jpg,gif,svg',
            'name' => 'required'
        ]);

        
        $category = Category::findOrFail($id);

        $category->name = $request->name;
        $category->description = $request->description;
        
        if ($request->has('icon')) 
        {
            if(file_exists(public_path("storage/images/icons/$category->icon")))
            {
                unlink(public_path("storage/images/icons/$category->icon"));
            } 
            $iconName = '_icon'.time().'.'.$request->icon->getClientOriginalExtension();
            $request->icon->move(public_path('storage/images/icons'), $iconName);            
            $image = Image::make(public_path('storage/images/icons/'.$iconName))->resize(500, 320);
            $image->save();
            $category->icon = $iconName;
        }

        // dd($category);
        if($category->save())
        {
            return back()->with('success','Category updated successfuly :)');
        }
        else
        {
            return back()->with('faild','Cann\'t update Category :(');
        } 
    }



    public function destroy($id)
    {
        try
        {
            $category = Category::findOrFail($id);
            
            if(file_exists(public_path("storage/images/icons/$category->icon"))){
                unlink(public_path("storage/images/icons/$category->icon"));
            } 

            if ($category->images->isNotEmpty()) {

                foreach($category->images as $image){
                    if(file_exists(public_path("storage/images/$image->name"))){
                        unlink(public_path("storage/images/$image->name"));
                    } 
                }
            }

            $category->delete();
            
            return back()->with('success-removed','Category Removed Successfully :)');
        }
        catch(Exception $ex)
        {
            return back()->with('faild-removed','Remove Category Faild :(');
        }
    }
}
