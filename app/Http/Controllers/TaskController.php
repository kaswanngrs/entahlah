<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource. use api  this function get all task  and create new link 
     *
     * @return \Illuminate\Http\Response
     */
    public function indexApi()
    {
        //
      $Task = Task ::all();
      $arrayTask  =array();
      foreach ($Task  as $task){
        

        $arrayTask[] =  url('').'/api/auth/ShowLink/'.$task->id; 

      }
      return response()->json([$arrayTask],200);

    }
    


    public function ShowLink($id)
    {
        //
        $Task = Task ::find($id);
        
        if($Task != null )
            return response()->json(["msg" => "you have error "],401);
    
        return  redirect()->away($Task->Task);


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
        $Task = Task ::create(["Task" => $request->input('Task')]) ;  
        return back();
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
        // 
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}