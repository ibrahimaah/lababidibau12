<?php

namespace App\Http\Controllers;

use App\Models\Temp;
use App\Models\Video;
use Illuminate\Http\Request;

class TempController extends Controller
{
    public function index()
    {
        return view('temp');
    }
    // public function store(Request $request)
    // {
    //     $temp = new Temp();
    //     $temp->temp = $request->temp;
    //     $temp->save();
    //     return back();

    // }
    public function show()
    {
        $temp = Temp::find(2);
        return view('temp')->withTemp($temp);
    }
    public function store(Request $request)
    {
        dd($request->img);
    }
}
