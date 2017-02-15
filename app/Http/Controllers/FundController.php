<?php

namespace evolunt\Http\Controllers;

use Auth;
use evolunt\Fund;
use Illuminate\Http\Request;

class FundController extends Controller
{
    //
    public function index()
    {
        if (Auth::check())
        {

            if (Auth::user()->charity == 1) {
                $funds = fund::orderBy('created_at', 'desc')
                    ->paginate(10);
            } else {

                $funds = fund::where
                (
                    function ($query) {
                        return $query->where
                        ('user_id', Auth::user()->id)
                            ->orWhereIn
                            (
                                'user_id', Auth::user()
                                ->iFollow()
                                ->pluck('id')
                            );
                    }
                )->orderBy('created_at', 'desc')
                    ->paginate(10);

            }

            $yourfunds = fund::where
            (
                function ($query) {
                    return $query->where
                    ('user_id', Auth::user()->id);
                }
            )->orderBy('created_at', 'desc')
                ->paginate(10);


            return view('fund.index')
                ->with('funds', $funds)
                ->with('yourfunds', $yourfunds);
        }

    }

    public function view($fund)
    {
        $fund = Fund::where('id',$fund)->first();
        return view('fund.view')->with('fund', $fund);
    }

    public function support($fundId)
    {
        $fund = Fund::where('id',$fundId)->first();

        if(Auth::user()->hasSupported($fund)){
            return redirect()->back();
        }

        $notification = $fund->notifications()->create([
            'user_id' =>  Auth::user()->id,
            'friend_id' => $fund->user_id
        ]);

        Auth::user()->notifications()->save($notification);

        return $this->index()->with('info', 'Message sent');
    }

    public function addFund()
    {
        if(Auth::check())
        {
            $funds = Fund::where
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

            return view('fund.add')
                ->with('funds',$funds);
        }

    }

    public function postFund(Request $request)
    {
        $this->validate($request, [
            'cause' => 'required|max:50',
            'description' => 'required|max:140',
            'amount' => 'required'
        ]);

        Auth::user()->funds()->create([
            'cause' => $request->input('cause'),
            'description' => $request->input('description'),
            'amount' => $request->input('amount'),
        ]);

        return redirect()->route('fund.index')->with('info','Fundraiser Created');
    }
}
