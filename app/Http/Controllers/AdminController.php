<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // if (isset($_COOKIE['name'])) 
        // {
            return view('Admin');
        // }
        // else
        // {
        //     return redirect()->route('Login');
        // }
    }
}
