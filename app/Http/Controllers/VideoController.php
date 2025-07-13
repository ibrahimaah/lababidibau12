<?php

namespace App\Http\Controllers;


use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();
        return view('video')->withVideos($videos);
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
        //dd(11111111);
        $request->validate([
            'thumb' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg',
            'title' => 'required',
            'name' => 'required'
        ]);
        //dd(111111111111);
        $mime = $request->name->getMimeType();

        if ($mime == "video/x-flv" || $mime == "video/mp4" || $mime == "application/x-mpegURL" || $mime == "video/MP2T" || $mime == "video/3gpp" || $mime == "video/quicktime" || $mime == "video/x-msvideo" || $mime == "video/x-ms-wmv") 
        {

            $video = new Video();

            $thumbName = $video->thumb.'_image'.time().'.'.$request->thumb->getClientOriginalExtension();
            $request->thumb->move(public_path('storage/videos/thumbnails'), $thumbName);

            $videoName = $video->name.'_video'.time().'.'.$request->name->getClientOriginalExtension();
            $request->name->move(public_path('storage/videos'), $videoName);

            $video->thumb = $thumbName;
            $video->name = $videoName;
            $video->title = $request->title;
            
            if($video->save())
            {
               return back()->with('success','Video added successfully :)'); 
            }
            
            return back()->with('faild','Image added faild :('); 
        }
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        if(file_exists(public_path("storage/videos/$video->name")))
        {
            if(file_exists(public_path("storage/videos/thumbnails/$video->thumb")))
            {
                unlink(public_path("storage/videos/$video->name"));
                unlink(public_path("storage/videos/thumbnails/$video->thumb"));
                $video->delete();
                return back()->with('success-removed','Video Removed Successfully :)');
            }
        } 
        return back()->with('faild-removed','Video Can\'t be removed :(');
    }
}
