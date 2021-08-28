<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\notifcation;
class notifctionController extends Controller
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.notifcation.create');
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

        
        
        $message = $request->input('message');
        $notifcation = notifcation ::create([
                                             'message'=> $message
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
              "body": "' . $message . '",
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

        return back();
    }

    public function getAllNotifcation(Request $request)
    {

        $notifcation = notifcation ::orderBy('updated_at', 'desc')->limit(5)->get();
        return response()->json(['notifcation' => $notifcation ,'mesg'=>'success get last 5  notifcation '], 202);

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
