<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Http\Request;

class MapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $map = Map::find(1);
        if($map)
        {
            return view('map')->withCounters($map);
        }
        return view('map');
    }

    
    public function update(Request $request)
    {
        
        $map = Map::find(1);
        //if there were not contacts data then add a new row
        if(!$map)
        {
            $map = new Map(); 
        }
        
        $map->map = $request->map;
        
        if($map->save())
        {
            return back()->with('success','Map Info Updated Successfully :)');
        }
        else
        {
            return back()->with('faild','Cann\'t update Map Info :(');
        }  
    }
}
