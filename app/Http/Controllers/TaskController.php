<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\UserPoints;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::get();
        return view('admin.task.Show', compact('tasks'));
    }


    /**
     * Display a listing of the resource. use api  this function get all task  and create new link
     *
     * @return \Illuminate\Http\Response
     */
    public function indexApi()
    {
        //
        $Task = Task::all();
        $arrayTask  = array();
        foreach ($Task  as $task) {


            $arrayTask[] =  url('') . '/api/auth/ShowLink/' . $task->id;
        }
        return response()->json([$arrayTask], 200);
    }



    public function ShowLink($id)
    {
        $Task = Task::find($id);
        if ($Task == null)
            return response()->json(["msg" => "you have error "], 401);

        return  redirect()->away($Task->Task);
    }


    public function addPointTask(Request $request)
    {

        $user_points = \App\UserPoints::updateOrCreate(
            [
                'user_id'   => Auth::user()->id,
            ],
            [
                'game_id' => 0,
                'points' => Auth::user()->user_points ? Auth::user()->points : 0,
            ]
        );
        $user_points->increment('points', 15);
        $user_points->save();
        return response()->json(['task' => 'success Add task point ', 'Add_point' => true], 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.task.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //
        $Task = Task::create(["Task" => $request->input('Task')]);
        return redirect()->route('show');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = Task::where('id', $id)->first();
        return view('admin.task.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'task' => 'required'
        ]);
        $input['task'] = $request->task;
        DB::table('tasks')->where('id', '=', $id)->update($input);
        return redirect()->route('show');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tasks = Task::find($id);
        $tasks->delete();
        return back();
    }
}
