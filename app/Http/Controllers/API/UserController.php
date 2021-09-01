<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserPoints;
use Illuminate\Support\Facades\Auth;
// use Validator;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public $successStatus = 200;
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */


    public function x()
    {


        return "x";
    }


    public function For_Get_Pasword(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => ['required'],
            'password'   => ['required', 'string'],
            'configPass' => ['required', 'string', 'same:password']
        ]);
        if ($validator->fails())
            return response()->json(['error' => $validator->errors()], 401);

        $User  = User::where('email', '=', $request->input('email'))->first();
        $User->update([
            'password' => bcrypt($request->input('password'))
        ]);

        return response()->json(['success' => true, 'mesg' => 'success reset password '], 202);
    }

    public function check_code_Password(Request $request)
    {
        $flag = true;
        $validator = Validator::make(request()->all(), [
            'code' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }


        $password_resets = DB::table('password_resets')->where('token', $request->input('code'))->first();

        if ($password_resets === null)
            $flag = false;

        if ($flag  === true)
            $message = "mcode is math";
        else
            $message = "mcode is  not math";
        return response()->json(['success' =>  $flag, 'mesg' => $message], 200);
    }

    public function password_resets(Request $request)
    {

        $validator = Validator::make(request()->all(), [
            'email' => 'required|email|exists:users',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }


        $token = Str::random(5);

        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,

        ]);

        $topic = "/topics/ostura";
        $apiAccess = 'AAAASbubh_U:APA91bFkpouLinHPUEkZWwyHyiujWKA-eOcebUB9WzWQ_I38Sq4Ng6ifhG8N6OX6TBgOb8N8aPEqhmI1wRLaIXMMN_qzXumMpMHwv7splCvIJIqbEaybABZ7KQ8dIadv5urXYFFkFkKV';
        $headers = array(
            'Authorization: key=' . $apiAccess,
            'Content-Type: application/json'
        );
        $fields = '{
          "to": "' . $topic . '",
              "notification": {
               "title": "اسطورة",
                "body": "' . $token  . '",
                "sound": "default",
                "color": "#990000",
              },
              "priority": "high",
              "data": {
               "click_action": "FLUTTER_NOTIFICATION_CLICK",

                },
              }';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ($fields));
        $result = curl_exec($ch);
        curl_close($ch);

        return response()->json(['success ' => 'is successfully'], 200);
    }
    public function login()
    {


        try {
            $falg = false;
            $validator = Validator::make(request()->all(), [

                'token_App' => ['required', 'string'],
                // 'c_password' => 'required|same:password',
            ]);
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 401);
            }


            if (request('social_media') == 0) {

                if (Auth::attempt(['email' => request('email'), 'password' => request('password')]))
                    $falg = true;
            } else {
                $falg = true;
                $user = User::where('email', "=", request('email'))->first();
                if ($user  !==  null)
                    Auth::loginUsingId($user->id);
                else {
                    $input =  request()->all();
                    $validator = Validator::make( $input, [
                        'name' => ['required', 'string', 'max:255'],
                        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                        'age' => ['required', 'integer'],
                        'token_App' => ['required', 'string'],
                        // 'c_password' => 'required|same:password',
                    ]);
                    if ($validator->fails()) {
                        return response()->json(['error' => $validator->errors()], 401);
                    }
                    $input['referral_code'] = Str::random(6);
                    $user = User::create($input);
                }
            }

            if ($falg) {
                $user = Auth::user();
                $User = User::find($user->id);
                if ($User  !== null)
                    $User->update(['token_App' => request('token_App')]);

                $success['token'] =  $User->createToken('MyApp')->accessToken;
                return response()->json(['success' => $success, 'user' => $User], $this->successStatus);
            } else {
                return response()->json(['error' => 'Unauthorised'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e], 401);
        }
    }
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'age' => ['required', 'integer'],
            'token_App' => ['required', 'string'],
            // 'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['referral_code'] = Str::random(6);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
        $success['user'] =  $user;
        return response()->json(['success' => $success], $this->successStatus);
    }
    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {
        $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function index()
    {
        $users = User::all()->where('role', 'user');

        return view('admin.users.index', ['users' => $users]);
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            return view('admin.users.edit', ['user' => $user]);
        }
        return view('admin.users');
    }
    public function delete($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->delete();
            return redirect('/users')->with('error', 'User Delete Successfully.');
        }
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->age = $request->age;
            $user->status = $request->status;

            $user->save();
            return redirect('/users')->with('success', 'User Update Successfully.');
        }
        return redirect('/users')->with('error', 'User Update Failed.');
    }

    public function setUserPoint(Request $request)
    {
        if (Auth::user()) {
            $points = new UserPoints();
            $points->user_id = Auth::user()->id;
            $points->game_id = $request->game_id;
            $points->points = $request->points;
            $points->save();

            return response()->json(['success' => Auth::user()], $this->successStatus);
        }
    }
}
