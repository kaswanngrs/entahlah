<?php

namespace App\Http\Controllers;

use App\awards;
use App\Models\User;
use Illuminate\Http\Request;
use App\Questions;
use App\Task;

class HomeController extends Controller
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
        $user=User::count();
        $question=Questions::count();
        $task=Task::count();
        $award=awards::count();
        return view('home',compact('user','question','task','award'));
    }
}
