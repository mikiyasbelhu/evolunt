<?php

namespace evolunt\Http\Controllers;

use Auth;
use evolunt\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    //
    public function index()
    {
        return view('friends.view');
    }

    public function getFollow($username)
    {
        $user = User::where('username',$username)->first();

        if(!$user)
        {
            return redirect()->route('home')
                ->with('info','The user could not be found');
        }

        Auth::user()->Follow($user);

        return redirect()
            ->back()
            ->with('info', "You are now following ".$user->getNameOrUsername());
    }

    public function postUnfollow($username)
    {
        $user = User::where('username',$username)->first();

        if(!Auth::user()->isFollowing($user))
        {
            return redirect()->back();
        }

        Auth::user()->Unfollow($user);

        return redirect()
            ->back()
            ->with('info', "You are no longer following ".$user->getNameOrUsername());

    }
}
