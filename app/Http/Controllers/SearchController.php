<?php

namespace evolunt\Http\Controllers;

use DB;
use evolunt\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function getResults(Request $request)
    {
        $query = $request->input('query');

        if(!$query){
            return redirect()->route('home');
        }

        $users = User::where(DB::raw("CONCAT(first_name, ' ', last_name)"), 'LIKE', "%{$query}%")
            ->orWhere('username', 'LIKE', "%{$query}%")
            ->orWhere('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        return view('search.results')
            ->with('users',$users)
            ->with('query',$query);
    }
}
