<?php

namespace App\Http\Controllers;

use App\awards;
use App\Models\User;
use App\UserPoints;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersChangeController extends Controller
{
    public function updateprofile(Request $request)
    {
        $id = Auth::user()->id;
        $this->validate(
            $request,
            [
                'email'                => 'required|email',
                'number_id_pubg'       => 'nullable',
                'number_id_freefire'   => 'nullable',
                'number_id_googleplay' => 'nullable',
            ]
        );
        $data['email']                       = $request->email;
        $data['number_id_pubg']              = $request->number_id_pubg;
        $data['number_id_freefire']          = $request->number_id_freefire;
        $data['number_id_googleplay']        = $request->number_id_googleplay;

        $user = User::where('id', $id)->update($data);
        return response()->json([
            'user_updated' => true,
            'user' => $data
        ], 201);
    }

    public function check_number_id()
    {
        $user = Auth::user();
        $number_id_googleplay = $user->number_id_googleplay ? true : false;
        $number_id_freefire = $user->number_id_freefire ? true : false;
        $number_id_pubg = $user->number_id_pubg ? true : false;

        return response()->json(['number_id_pubg' => $number_id_pubg,
        '$number_id_freefire' => $number_id_freefire,
        'number_id_googleplay' => $number_id_googleplay
    ],200);
    }

    public function minuspoint(Request $request)
    {
        $id = Auth::user()->id;
        $userpoint=UserPoints::where('user_id',$id)->first();
        $vocher=awards::where('id',$request->idawards)->first();
        // dd($vocher);
        if($vocher && $userpoint)
        {
            $total=($userpoint->points)-($vocher->point);
            return response()->json(['total'=>$total],200);
        }
        return response()->json(['total'=>0],200);

    }
}
