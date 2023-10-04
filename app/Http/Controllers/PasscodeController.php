<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PasscodeController extends Controller
{
    public function setPasscode(Request $request){
        $passcode = $request->passcode;
        if($passcode === "Bazooka1!"){
            session(['passcode' => 'Bazooka1!']);
            return response()->json(['status' => true , "msg" => "Passcode matched successfully"]);
        }else{
            return response()->json(['status' => false , "msg" => "Passcode doesn't found"]);
        }
    }
}
