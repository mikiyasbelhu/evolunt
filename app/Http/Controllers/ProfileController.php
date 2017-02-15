<?php

namespace evolunt\Http\Controllers;

use Auth;
use evolunt\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function getProfile($username)
    {
        $user = User::where('username',$username)->first();

        if (!$user)
        {
            abort(404);
        }

        $statuses = $user->statuses()
            ->notReply()
            ->orderBy('created_at','desc')
            ->paginate(10);

        return view('profile.view')
            ->with('user',$user)
            ->with('statuses',$statuses);
            //->with('authUserIsFollowing', Auth::user()->whofollowsMe());
    }

    public function getEdit()
    {
        return view('profile.edit');
    }

    public function postEdit(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'alpha|max:50',
            'last_name' => 'alpha|max:50',
            'location' => 'alpha|max:30',
        ]);

        Auth::user()->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'location' => $request->input('location')
        ]);

        return redirect()
            ->route('profile.edit')
            ->with('info','Successfully updated');
    }
}

