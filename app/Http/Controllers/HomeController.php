<?php

namespace evolunt\Http\Controllers;

use Auth;
use evolunt\Status;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check())
        {
            $statuses = Status::notReply()-> where
            (
                function($query){
                    return $query->where
                    ('user_id', Auth::user()->id)
                        ->orWhereIn
                        (
                            'user_id',Auth::user()
                            ->iFollow()
                            ->pluck('id')
                        );
                }
            )->orderBy('created_at','desc')
                ->paginate(10);

            return view('timeline.index')
                ->with('statuses',$statuses);
        }


        return view('home');
    }

    public function test()
    {
        return view('test.test');
    }
}
