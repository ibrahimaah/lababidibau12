<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Cookie;

class LoginController extends Controller
{
    public function index()
    {
        if (isset($_COOKIE['name'])) {
            return view('admin');
        }
        
        return view('Login');
    }
    public function login(Request $request)
    {
        $result = User::where('name', $request->name)->where('password', $request->password)->get();
        // dd($result);
        if($result && count($result) > 0){
            setcookie('name', $request->name, time() + (86400 * 1), "/");
            //return view('admin');
            return redirect('/admin/slider');
        }
        return back()->with('faild', 'Username or Password is incorrect');
    }


    public function logout()
    {
        if (isset($_COOKIE['name'])) {
            unset($_COOKIE['name']); 
            setcookie('name', null, -1, '/'); 
        }
        return redirect('/Login');
    }

}
