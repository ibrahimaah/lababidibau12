<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('change-password');
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
        $user = User::find(1);
        //if there were not contacts data then add a new row
        if(!$user)
        {
            $user = new User(); 
        }
        
        $new_pwd = $request->new_password;
        $confirm_pwd = $request->confirm_password;
        if($new_pwd != $confirm_pwd)
        {
            return back()->with('faild','Cann\'t update Password :(');
        }

        $user->password = $new_pwd;
        
        if($user->save())
        {
            return back()->with('success','Password Updated Successfully :)');
        }
        else
        {
            return back()->with('faild','Cann\'t update Password :(');
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

    // public function index_whatsapp()
    // {
    //     return view('change-whatsapp');
    // }

    // public function update_whatsapp(Request $request)
    // {
    //     $user = User::find(1);
    //     //if there were not contacts data then add a new row
    //     if(!$user)
    //     {
    //         $user = new User(); 
    //     }
        
    //     $user->whatsapp = $request->whatsapp;
        
    //     if($user->save())
    //     {
    //         return back()->with('success','WhatsApp Updated Successfully :)');
    //     }
    //     else
    //     {
    //         return back()->with('faild','Cann\'t update WhatsApp :(');
    //     }  
    // }
}
