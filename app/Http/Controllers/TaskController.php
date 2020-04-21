<?php

namespace App\Http\Controllers;

use App\Task;
use App\Task_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
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
        $user = Auth()->user()->status;
        if($user == 1 || $user == 3){
            return redirect('/show-tour');
        }else if($user == 2){
            return redirect('/show-task');
        }else{
            return view('v_task-error');
        }
    }
    public function show_task()
    {
        $Task = DB::table('Task_details')
            ->leftjoin('Tasks','Task_details.task_id','tasks.id')
            ->where('Task_details.user_id',Auth()->user()->id)
            ->select('Tasks.*')
            ->get();
      
            return view('v_task')->with(compact('Task'));
    }
    public function get_taskByUser(Request $request)
    {
            $Task = DB::table('Task_details')
            ->leftjoin('Tasks','Task_details.task_id','tasks.id')
            ->where('Task_details.user_id',$request->user_id)
            ->select('Tasks.*')
            ->get();
        
            return compact('Task');
    }
}
