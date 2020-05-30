<?php

namespace App\Http\Controllers;
use App\Task;
use App\User;
use App\Card;
use App\Task_detail;
use Illuminate\Http\Request;

class TourController extends Controller
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
        $user_Auth = Auth()->user()->status;
        $task = Task::orderBy('date_start','desc')->get();
        $task_detail = Task_detail::All();
        $guide = User::where('status',2)->get();
        $card = Card::All();
        $user = User::All();
        if($user_Auth == 1 || $user_Auth == 3){
            return view('v_tour')->with(compact('guide', 'task','card','task_detail','user'));
        }else{
           
        }
    }
    public function insert(Request $request)
    {
        
        $tour = new Task;
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images/task'), $imageName);
        $tour->name = $request->name;
        $tour->description = $request->detail;
        $tour->guide_id = $request->guide;
        $tour->date_start = $request->date_start;
        $tour->date_end = $request->date_end;
        $tour->status = $request->status;
        $tour->type_id = $request->type_card;
        $tour->image = $imageName;
        $tour->price = $request->price;
        $tour->save();
        return redirect('/show-tour');

    }
    public function update(Request $request)
    {
        $tour = Task::find($request->id);
        if(isset($request->image)){
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images/task'), $imageName);
        $tour->image = $imageName;
        }
        $tour->name = $request->name;
        $tour->description = $request->detail;
        $tour->guide_id = $request->guide;
        $tour->date_start = $request->date_start;
        $tour->date_end = $request->date_end;
        $tour->status = $request->status;
        $tour->type_id = $request->type_card;
        $tour->price = $request->price;
        $tour->save();
        return redirect('/show-tour');
    }
    public function delete(Request $request)
    {
        // $tour = Task::find($request->id);
        Task::where('id',$request->id)->delete();
        // $tour->delete();
        return redirect('/show-tour');
    }
    public function add_guide(Request $request)
    {
            foreach($request->check as $val){
                $Task_details = new Task_detail;
                $Task_details->user_id = $val;
                $Task_details->task_id = $request->id;
                $Task_details->save();
            }
        return redirect('/show-tour');
    }
}
