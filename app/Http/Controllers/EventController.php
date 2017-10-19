<?php

namespace evolunt\Http\Controllers;

use Auth;
use evolunt\EventModel;
use evolunt\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{

    public function index()
    {
        $allevents = Event::where
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

        $yourevents = Event::where
        (
            function($query){
                return $query->where
                ('user_id', Auth::user()->id);
            }
        )->orderBy('created_at','desc')
            ->paginate(10);

        $events = [];

        foreach($allevents as $event){
        $events[] = \Calendar::event(
            $event->title, //event title
            true, //full day event?
            $event->date, //start time (you can also use Carbon instead of DateTime)
            $event->date, //end time (you can also use Carbon instead of DateTime)
            0 //optionally, you can specify an event ID
        );
    }

        $calendar = \Calendar::addEvents($events);

        return view('event.index', compact('calendar'))
            ->with('events',$allevents)
        ->with('yourevents',$yourevents);
    }

    public function add()
    {
        if(Auth::check())
        {
            $events = Event::where
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

            return view('event.add')
                ->with('events',$events);
        }

    }

    public function postEvent(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:50',
            'description' => 'required|max:140',
            'date' => 'required|date|after_or_equal:today'
        ]);

        Auth::user()->events()->create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'date' => $request->input('date'),
        ]);

        return redirect()->route('event.index')->with('info','Event Created');
    }


}
