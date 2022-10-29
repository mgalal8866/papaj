<?php

namespace App\Http\Controllers;

use App\Models\fcm;
use Jenssegers\Agent\Agent;
use Illuminate\Http\Request;

class FcmController extends Controller
{
    public function updateToken(Request $request){

        $agent = new Agent();
        $platform  = $agent->platform();
        $browser    = $agent->browser();
        $device = $agent->device();
        $version = $agent->version($browser);
        $platformVer  =$agent->version($platform);

    $agentuser =  ['Device' => $device , 'Browser'=> $browser ,  'Browser_version'=> $version ,'platform' =>$platform ,'platform_version'=>   $platformVer ];

    $fcm =   fcm::where('fcm_token',$request->token)->get();
     if ($fcm->count() == 0){
       fcm::create(['fcm_token'=>$request->token,'ip'=>$request->ip(),'agent'=> json_decode(['Device' => $device , 'Browser'=> $browser ,  'Browser_version'=> $version ,'platform' =>$platform ,'platform_version'=> $platformVer]) ,'admin'=>$request->admin??0]);
     }
        // return response()->json(['success'=>true]);
        // return response()->json(['success'=>false],500);
    }
}
