<?php

namespace App\Http\Controllers;

use App\Card;
use App\Card_detail;
use Illuminate\Http\Request;

class CardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $card = Card::all();
        return view('v_card')->with(compact('card'));
    }
    public function get_card(Request $request)
    {
        $img = Card_detail::where('user_id',$request->user_id)->where('card_id',$request->type_card)->get();
        return compact('img');
    }
    public function get_cardByID(Request $request)
    {
        $card = Card::All();
        $img = Card_detail::leftjoin('cards','card_details.card_id','cards.id')
        ->where('user_id',Auth()->user()->id)
        ->select('card_details.*','cards.name as card_name')
        ->get();
        // dd($img);
        return view('v_manageCard')->with(compact('img','card'));
    }
    public function insert(Request $request)
    {
        $card = new Card;
        $card->name = $request->name;
        $card->price = $request->price;
        $card->detail = $request->detail;
        $card->save();
        return redirect('/manage-card');
    }
    public function update(Request $request)
    {
        $card = Card::find($request->id);
        $card->name = $request->name;
        $card->price = $request->price;
        $card->detail = $request->detail;
        $card->save();
        return redirect('/manage-card');
    }
    public function insert_card_detail(Request $request)
    {
        $card = new Card_detail;
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images/card'), $imageName);
        $card->card_id = $request->type_card;
        $card->user_id = Auth()->user()->id;
        $card->img = $imageName;
        $card->save();
        return redirect('/manage-yourcard');
    }
    public function delete_card(Request $request)
    {
        $tour = Card_detail::find($request->id);
        $tour->delete();
        return redirect('/manage-yourcard');
    }
    public function delete_type(Request $request)
    {
        $tour = Card::find($request->id);
        $tour->delete();
        return redirect('/manage-card');
    }
    
    
}
