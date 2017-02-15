<?php

namespace evolunt\Http\Controllers;

use Auth;
use evolunt\User;
use Illuminate\Http\Request;

class CharityController extends Controller
{
    //
    public function index()
    {
        return view('charity.view');
    }

    public function getSignup()
    {
        return view('charity.add');

    }

    public function postSignup(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|unique:users|email|max:255',
            'username' => 'required|unique:users|alpha_dash|max:20',
            'password' => 'required|min:6',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
            'name' => 'required|unique:users|max:50',
            'description' => 'required',
        ]);

        $imageName = time().'.'.$request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);


        User::create([
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password')),
            'picture' =>  $imageName,
            'admin' => '0',
            'charity' => '1',
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);

        return  redirect()->route('home')->with('info','You have added the Charity successfully');
    }
}
