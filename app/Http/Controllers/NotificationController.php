<?php

namespace evolunt\Http\Controllers;

use Auth;
use evolunt\Notification;

class NotificationController extends Controller
{
    //
    public function index()
    {
        $notifications = Notification::where
        (
            function ($query) {
                return $query->where
                ('friend_id', Auth::user()->id);
            }
        )->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('notification.view')->with('notifications', $notifications);
    }
}
