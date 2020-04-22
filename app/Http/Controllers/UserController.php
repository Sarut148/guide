<?php

namespace App\Http\Controllers;

use App\Card_detail;
use Illuminate\Http\Request;
use App\User;
use DB;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
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
       
    }
    public function get_all(Request $request)
    {
        
        $user = User::where('status',2)
        ->leftjoin('task_details','users.id','task_details.user_id')
        ->groupBy('users.id')
        ->select(DB::raw('count(task_details.id) as task_number ,users.*'))
        ->get();
        return view('v_guide')->with(compact('user'));
    }

    public function get_byCard(Request $request)
    {
        // $User =  User::where('status',2)->where('name','Like','%'.$request->name_guide.'%')->get();
        $Task =  DB::table('users')
        ->leftJoin('task_details','users.id','task_details.user_id')
        ->leftJoin('tasks','task_details.task_id','tasks.id')
        ->leftJoin('card_details','users.id','card_details.user_id')
        ->leftJoin('cards','card_details.card_id','cards.id')
        ->where('card_details.card_id',$request->type_card)
        ->where('users.status',2)
        ->where('users.name','Like','%'.$request->name_guide.'%')
        ->groupBy('users.id')
        ->select(DB::raw('count(task_details.user_id) as task_number,sum(tasks.price)+cards.price as task_price ,users.*'))
        ->get();
        // $Card_detail = Card_detail::where('card_id',$request->type_card)->get();
         return compact('Task');
    }
    
    public function get_youself()
    {
        $user =  DB::table('users')
        ->where('users.id',Auth()->user()->id)
        ->get();

        return view('v_profile')->with(compact('user'));

    }
    public function update(Request $request)
    {
        $user = User::find(Auth()->user()->id);
        if(isset($request->image)){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images/user'), $imageName);
        $user->img = $imageName;
        }
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect('/manage-profile');
    }
}
