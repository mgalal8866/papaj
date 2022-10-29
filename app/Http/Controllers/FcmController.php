<?php

namespace App\Http\Controllers;

use App\Models\fcm;
use Illuminate\Http\Request;

class FcmController extends Controller
{
    public function updateToken(Request $request){
        $s = fcm::create(['fcm_token'=>$request->token,'ip'=>$request->ip(),'agent' => $request->header('User-Agent')]);
        // try{
        //     $request->fcm()->update(['fcm_token'=>$request->token]);
            return response()->json([
                'success'=>true
            ]);
        // }catch(\Exception $e){
        //     report($e);
            return response()->json([
                'success'=>false
            ],500);
        // }
    }
}
