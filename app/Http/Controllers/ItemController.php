<?php

namespace evolunt\Http\Controllers;

use Auth;
use evolunt\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    //
    public function index()
    {
        if (Auth::check()) {

            if (Auth::user()->charity == 1) {
                $items = Item::orderBy('created_at', 'desc')
                    ->paginate(10);
            } else {

                $items = Item::where
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

            $yourItems = Item::where
            (
                function ($query) {
                    return $query->where
                    ('user_id', Auth::user()->id);
                }
            )->orderBy('created_at', 'desc')
                ->paginate(10);


            return view('item.index')
                ->with('items', $items)
                ->with('yourItems', $yourItems);
        }

    }

    public function view($itemId)
    {
        $item = Item::where('id',$itemId)->first();
        return view('item.view')->with('item', $item);
    }

    public function ask($itemId)
    {
        $item = Item::where('id',$itemId)->first();

        if(Auth::user()->hasAsked($item)){
            return redirect()->back();
        }

        $notification = $item->notifications()->create([
            'user_id' =>  Auth::user()->id,
            'friend_id' => $item->user_id
        ]);

        Auth::user()->notifications()->save($notification);

        return $this->index()->with('info', 'Message sent');
    }


    public function addItem()
    {
        $items = Item::where
        (
            function ($query) {
                return $query->where
                ('user_id', Auth::user()->id);
            }
        )->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('item.add')
            ->with('items', $items);
    }

    public function postItem(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'description' => 'required|max:140',
            'quantity' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

        $imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('images'), $imageName);

        Auth::user()->items()->create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'quantity' => $request->input('quantity'),
            'picture' => $imageName
        ]);

        return redirect()->route('item.index')->with('info', 'Item Donated');
    }
}
