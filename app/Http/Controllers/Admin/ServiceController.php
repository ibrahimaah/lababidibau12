<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    // /**
    //  * Display a listing of the resource.
    //  */
    // public function index()
    // {
    //     return view('admin.about.services.index', [
    //         'services' => Service::all()
    //     ]);
    // }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'service' => 'required'
        ]);

        $service = new Service();
        $service->name = $request->service;

        if($service->save())
        {
            return back()->with('success','Service added successfully :)'); 
        }
        
        return back()->with('faild','Service added faild :('); 
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Service::find($id)->delete();
        return back()->with('success-removed','Service Removed Successfully :)');
    }
}
