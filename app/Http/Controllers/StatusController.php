<?php

namespace evolunt\Http\Controllers;

use Auth;
use evolunt\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    //
    public function postStatus(Request $request)
    {
        $this->validate($request, [
           'status' => 'required|max:140'
        ]);

        Auth::user()->statuses()->create([
            'body' => $request->input('status'),
        ]);

        return redirect()->route('home')->with('info','Status Updated');
    }

    public function postReply(Request $request,$statusId)
    {
        $this->validate($request,
            [
               "reply-{$statusId}" => 'required|max:1000',
            ],
            [
                'required' => 'Thre reply body is required.'
            ]);

        $status = Status::notReply()->find($statusId);

        if (!$status)
        {
            return redirect()-route('home');
        }
        //Auth::user()->isFollowing($status->user)
       // if(!(false) && Auth::user()->id !== $status->user->id ){
         //   return redirect()->route('home');
       // }

        $reply = Auth::user()->statuses()->create([ 'body' => $request->input("reply-{$statusId}"),
            'user_id' => Auth::user()->id,
        ]);

        $status->replies()->save($reply);

        return redirect()->back();
    }

    public function getLike($statusId)
    {
       $status = Status::find($statusId);

        if(!$status)
        {
            return redirect()->route('home');
        }

        if(Auth::user()->hasLikedStatus($status)){
            return redirect()->back();
        }

        $like = $status->likes()->create([
            'user_id' =>  Auth::user()->id
        ]);

        Auth::user()->likes()->save($like);

        return redirect()->back();

    }

    public function getUnlike($statusId)
    {
        $status = Status::find($statusId);

        if(!$status)
        {
            return redirect()->route('home');
        }

        if(!Auth::user()->hasLikedStatus($status)){
            return redirect()->back();
        }

        $like = $status->likes
            ->where('likeable_id',$status->id)
            ->where('likeable_type', get_class($status))
            ->where('user_id',Auth::user()->id);

        Auth::user()->likes()->delete($like);

        return redirect()->back();

    }
}
