<?php

namespace evolunt\Http\Controllers;

use Auth;
use evolunt\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function getSignup()
    {
        return view('admin.signup');
    }

    public function postSignup(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|unique:users|email|max:255',
            'username' => 'required|unique:users|alpha_dash|max:20',
            'password' => 'required|min:6',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);


        User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'picture' =>  $imageName,
            'admin' => '1',
            'charity' => '0',
            'description' => NULL,
            'name' => NULL
        ]);

        return redirect()->route('home')->with('info','You have added an Admin successfully');
    }

    public function getSignout()
    {
        Auth::logout();
        return redirect()->route('home');
    }

}
