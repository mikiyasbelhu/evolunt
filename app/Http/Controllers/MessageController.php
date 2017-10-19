<?php

namespace evolunt\Http\Controllers;

use Auth;
use evolunt\User;
use evolunt\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {

        $messages = Message::where
        (
            function ($query) {
                return $query->where
                ('user_id', Auth::user()->id)
                    ->orWhere
                    ('friend_id', Auth::user()->id);
            }
        )->orderBy('created_at', 'desc')
            ->paginate(10);

        if ($messages->count()) {
            $friend_id = Message::where
            (
                function ($query) {
                    return $query->where
                    ('user_id', Auth::user()->id)
                        ->orWhere
                        ('friend_id', Auth::user()->id);
                }
            )->orderBy('created_at', 'desc')
                ->first()->friend_id;
            if ($friend_id == Auth::user()->id) {
                $friend_id = Message::where
                (
                    function ($query) {
                        return $query->where
                        ('user_id', Auth::user()->id)
                            ->orWhere
                            ('friend_id', Auth::user()->id);
                    }
                )->orderBy('created_at', 'desc')
                    ->first()->user_id;
            }

        } else {
            $friend_id = null;
        }

        return $this->view($friend_id);
    }

    public function view($friend_id)
    {
        $conversation = Message::where
        (
            function ($query) {
                return $query->where
                ('user_id', Auth::user()->id)
                    ->orWhere
                    ('friend_id', Auth::user()->id);
            }
        )->orderBy('created_at', 'desc')
            ->paginate(10);

        $user = User::where('id', $friend_id)->first();

        $messages = Message::where('user_id', '=', $friend_id)
            ->where('friend_id', '=', Auth::user()->id)->union(Message::where('user_id', Auth::user()->id)
                ->where('friend_id', '=', $friend_id))->orderBy('created_at', 'asc')->get();

        return view('message.view')
            ->with('conversation', $conversation)
            ->with('messages', $messages)
            ->with('user', $user)
            ->with('friend', $friend_id);
    }

    public function postMessage(Request $request, $friend_id)
    {
        $this->validate($request, [
            'content' => 'required|max:140'
        ]);

        Auth::user()->messages()->create([
            'content' => $request->input('content'),
            'friend_id' => $friend_id
        ]);

        return redirect()->route('message.view', $friend_id)->with('info', 'Message sent');
    }
}
