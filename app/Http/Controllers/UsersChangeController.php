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

        if ($data['number_id_pubg']  ===  null)
            unset($data['number_id_pubg']);
        if ($data['number_id_googleplay']  ===  null)
            unset($data['number_id_googleplay']);
        if ($data['number_id_freefire']   ===  null)
            unset($data['number_id_freefire']);


        $user = User::where('id', $id)->update($data);
        return response()->json([
            'user_updated' => true,
            'user' => $data
        ], 201);
    }

    public function getInformation()
    {
        $user = Auth::user();
        return response()->json(
            [
                'email' => $user->email,
                'number_id_pubg' => $user->number_id_pubg,
                'number_id_freefire' => $user->number_id_freefire,
                'number_id_googleplay' => $user->number_id_googleplay,
            ]
        );
    }

    public function check_number_id($type)
    {
        $user = Auth::user();
        if ($type === "pubg") {
            $number_id_pubg = $user->number_id_pubg ? true : false;
            return response()->json(['type' => 'pubg', 'number_id_pubg' => $number_id_pubg], 200);
        }
        if ($type === "googleplay") {
            $number_id_googleplay = $user->number_id_googleplay ? true : false;
            return response()->json(['type' => 'googleplay', 'number_id_pubg' => $number_id_googleplay,], 200);
        }
        if ($type === "freefire") {
            $number_id_freefire = $user->number_id_freefire ? true : false;
            return response()->json(['type' => 'freefire', 'number_id_pubg' => $number_id_freefire,], 200);
        }
    }
}
