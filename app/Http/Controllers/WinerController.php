<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Winer;
use App\awards;
use App\Mail\MailApprove;
use App\Models\User;
use App\UserPoints;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
// use Validator;
class WinerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $Winer  = Winer::paginate(10);

        return view('admin.request.index', compact('Winer'));
    }

    public function changestatus($id)
    {
        $winer = Winer::where('id', $id)->first();
        $iduser = $winer->user_id;
        $user = User::where('id', $iduser)->first();
        if ($winer->status == 0) {
            DB::table('winers')->where('id', '=', $id)->update(['status' => "1"]);
        }
        $userpoint = UserPoints::where('user_id', $iduser)->first();
        $vocher = awards::where('id', $winer->award_id)->first();
        if ($vocher && $userpoint) {
            if ($userpoint->points >=  $vocher->point) {
                $total = ($userpoint->points) - ($vocher->point);
                $userpoint = UserPoints::where('user_id', $iduser)->update(['points' => $total]);
                Mail::to($user->email)->send(new MailApprove($user));
                return back()->with('success', 'Approve Winer !');
            } else {
                //  return  response()->json(["empty data "}],200);
                return back()->with('error', 'empty data');
            }
        }
        return back()->with('error', 'empty data');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeApi(Request $request)
    {
        $this->validate($request, [
            'award_id' => 'required'
        ]);
        $awards = awards::find($request->award_id);
        $point = \App\UserPoints::where('user_id', '=', Auth::user()->id)->first();
        if ($awards === null)
            return response()->json([" The award does not exists  "], 401);
        if ($point === null)
            return response()->json([" You need to collect starting points "], 401);
        if ($point->points   <  $awards->point)
            return response()->json([" You need more point "], 401);
        $user_points = \App\UserPoints::updateOrCreate(
            [
                'user_id'   => Auth::user()->id,
            ],
            [
                'game_id' => 0,
                'points' => Auth::user()->user_points ? Auth::user()->points : 0,
            ]
        );
        // $user_points->decrement('points', $awards->point);
        $user_points->save();
        $Winer = Winer::create([
            "user_id" => Auth::user()->id,
            'award_id' =>  $request->input('award_id'),
        ]);
        return response()->json(["Winer" => $Winer, "point" => $user_points, 'Awards' => $awards, " You need more point "], 202);
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
