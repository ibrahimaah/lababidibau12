<?php

namespace App\Http\Controllers;

use App\Enums\PageFeatureEnum;
use App\Models\Counter;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $counters = Counter::find(1);
        if($counters)
        {
            return view('admin.home.counters.index',compact('counters'));
        }
        return view('counter');
    }

    public function toggleCounters(Request $request)
    {
        $enabled = $request->boolean('counters_status');
    
        PageFeatureEnum::HOME_COUNTERS->set($enabled);
    
        return back()->with(
            'counters_toggle_status',
            $enabled ? 'enabled' : 'disabled'
        );
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
        //
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
    public function update(Request $request)
    {
        $counter = Counter::find(1);
        //if there were not contacts data then add a new row
        if(!$counter)
        {
            $counter = new Counter(); 
        }
        
        $counter->clients = $request->client;
        $counter->projects = $request->project;
        $counter->years = $request->year;
        
        if($counter->save())
        {
            return back()->with('success','Counters Info Updated Successfully :)');
        }
        else
        {
            return back()->with('faild','Cann\'t update Counters Info :(');
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
        //
    }
}
