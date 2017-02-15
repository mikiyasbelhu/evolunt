<?php

namespace evolunt\Http\Controllers;

use Auth;
use evolunt\User;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    //
    public function getSignup()
    {
        return view('auth.signup');
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
            'admin' => '0',
            'charity' => '0',
            'description' => NULL,
            'name' => NULL
        ]);

        return redirect()->route('auth.signin')
        ->with('info','Your account has been created. Now you can log in.');
    }

    public function getSignin()
    {
        return view('auth.signin');
    }

    public function postSignin(Request $request)
    {
        $this->validate($request,[
            'email' => 'required',
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only(['email','password'])))
        {
            return redirect()->back()->with('info','Invalid email or password');
        }
        return  redirect()->route('home')->with('info','Welcome Back!!');
    }

    public function getSignout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
