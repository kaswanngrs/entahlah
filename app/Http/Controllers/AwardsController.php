<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\awards;
use Illuminate\Support\Facades\DB;
// use Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AwardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $awards = awards::paginate(10);
        return view('admin.awards.index', compact('awards'));
    }


    public function  indexApi()
    {
        $awards  = awards::all();
        return response()->json(["awards" => $awards], 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 'name', 'img', 'point'

        //    $awards = awards ::all();

        return view('admin.awards.create');
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
        $this->validate($request, [
            'name' => 'required', 'string', 'max:255',
            'img' => 'required',
            'type' => 'required',
            'point' => 'required|numeric',
        ]);

        $data['point'] =  (int) $request->input('point');
        $data['name'] = $request->input('name');
        $imageName = time() . '.' . $request->img->getClientOriginalExtension();
        $request->img->move(public_path('images/award'), $imageName);
        $data['img'] = $imageName;

        $data['type'] = $request->input('type');
        // dd($data);
        $awards = awards::create($data);
        return redirect()->route('show.awards');
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
        $award = awards::find($id);
        return view('admin.awards.edit', compact('award'));
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
        // $this->validate($request->all(),[

        // ]);

        $this->validate($request, [
            'name' => 'required', 'string', 'max:255',
            'img' => 'required',
            'type' => 'required',
            'point' => 'required|numeric',
        ]);

        $imageName = time() . '.' . $request->img->getClientOriginalExtension();
        $request->img->move(public_path('images/award'), $imageName);
        $input['img'] = $imageName;
        $input['name'] = $request->name;
        $input['point'] = $request->point;
        $input['type'] = $request->type;
        // dd($data);
        DB::table('awards')->where('id', '=', $id)->update($input);
        return redirect()->route('show.awards');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $awards = awards::find($id);
        //  dd($awards);
        $awards->delete();
        return back();
    }
}
