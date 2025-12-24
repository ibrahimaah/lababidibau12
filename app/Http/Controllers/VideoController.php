<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $videos = Video::with('media')->latest()->paginate(10);

        return view('video', compact('videos'));
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
            'thumb' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
            'title' => 'required|string|max:255',
            'name' => 'required|file|mimes:mp4,mov,avi,wmv,mkv|max:102400' // 100MB max
        ]);

        try {
            // Create video record
            $video = Video::create([
                'title' => $request->title,
            ]);

            // Add thumbnail to media library
            if ($request->hasFile('thumb')) {
                $video->addMediaFromRequest('thumb')
                    ->toMediaCollection('thumbnails');
            }

            // Add video to media library
            if ($request->hasFile('name')) {
                $video->addMediaFromRequest('name')
                    ->toMediaCollection('videos');
            }

            return back()->with('success', 'Video uploaded successfully!');

        } catch (\Exception $e) {
            // If something fails, delete the video record if it was created
            if (isset($video) && $video->exists) {
                $video->delete();
            }
            
            return back()->with('faild', 'Failed to upload video: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $video = Video::findOrFail($id);
            
            // Delete all media associated with the video
            $video->clearMediaCollection('thumbnails');
            $video->clearMediaCollection('videos');
            
            // Delete the video record
            $video->delete();

            return back()->with('success-removed', 'Video deleted successfully!');

        } catch (\Exception $e) {
            return back()->with('faild-removed', 'Failed to delete video: ' . $e->getMessage());
        }
    }
}