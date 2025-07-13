<?php

namespace App\Http\Controllers\Admin;

use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jobs = Job::all();
        if($jobs)
        {
            return view('admin.job.index')->withJobs($jobs);
        }
        return view('admin.job.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.job.create');
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
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'title' => 'required',
            'desc' => 'required',
            'contact' => 'required',
        ]);
        
        $job = new Job();

        $job->title = $request->title;
        $job->desc = $request->desc;
        $job->contact = $request->contact;

        //rename the image
        $imageName = '_job_image'.time().'.'.$request->img->getClientOriginalExtension();
        //upload the image
        $request->img->move(public_path('storage/images/jobs'), $imageName);
        //Resizing The Image
        $img = \Intervention\Image\Facades\Image::make(public_path('storage/images/jobs/'.$imageName))->resize(300, 300);
        $img->save();

        $job->img = $imageName;

        if($job->save())
        {
            return back()->with('success','Job added successfully :)'); 
        }

        return back()->with('faild','Job added faild :('); 

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job = Job::find($id);
        return view('admin.job.edit')->withJob($job);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'title' => 'required',
            'desc' => 'required',
            'contact' => 'required',
        ]);


        $job = Job::find($id);
        $job->title = $request->title;
        $job->desc = $request->desc;
        $job->contact = $request->contact;

        if(file_exists(public_path("storage/images/jobs/$job->img"))){
            unlink(public_path("storage/images/jobs/$job->img"));
        }


        //rename the image
        $imageName = '_job_image'.time().'.'.$request->img->getClientOriginalExtension();
        //upload the image
        $request->img->move(public_path('storage/images/jobs'), $imageName);
        //Resizing The Image
        $img = \Intervention\Image\Facades\Image::make(public_path('storage/images/jobs/'.$imageName))->resize(300, 300);
        $img->save();

        $job->img = $imageName;

        if($job->save())
        {
            return back()->with('success','Job Edited successfully :)'); 
        }

        return back()->with('faild','Job Edit faild :(');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Job  $job
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $job = Job::find($id);
        if(file_exists(public_path("storage/images/jobs/$job->img")))
        {
            unlink(public_path("storage/images/jobs/$job->img"));
            $job->delete();
            return back()->with('success-removed','Job Removed Successfully :)');
        }
        return back()->with('faild-removed','Job Can\'t be removed :(');
        
    }
}
