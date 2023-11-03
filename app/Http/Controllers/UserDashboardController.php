<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Billing;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class UserDashboardController extends Controller
{
    public function getDashboard(){

        $totalOrders = Billing::where('sender_id' , auth()->user()->id)->count();

        return view('dashboard')->with(['totalOrders' => $totalOrders]);
    }

    public function getProfileDetail(){

        $userDetail = User::where('id' , auth()->user()->id)->with('bankDetails')->first();

        return view('profile-detail')->with(['userDetail' => $userDetail]);

    }

    public function updateUserProfile(Request $request){
        $validator = Validator ::make($request->all() , [
            "first_name" => "required|string",
            "last_name" => "required|string",
            "phone" => "required|string"
        ]);

        if($validator->fails()){
            return response()->json(["status" => false , "msg" => "Something Went Wrong" , "error" => $validator->getMessageBag()]);
        }

        try{
            User::where('id' , auth()->user()->id)->update([ 
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'phone' => $request->phone
            ]);

            return response()->json(["status" => true , "msg" => "Profile Update Successfully"]);

        }catch(\Exception $e){

            return response()->json(["status" => false , "msg" => "Something Went Wrong" , "error" => $e->getMessage()]);
        
        }


    }

    public function updateUserPassword(Request $request){
        $validator = Validator ::make($request->all() , [
            "password" => "required|string",
            "new_password" => "required|string",
            "confirm_password" => "required|string|same:new_password"
        ]);

        if($validator->fails()){
            return response()->json(["status" => false , "msg" => "Something Went Wrong" , "error" => $validator->getMessageBag()]);
        }

        try{

           $userCheck = Hash::check($request->password , auth()->user()->password);

           if($userCheck){
               User::where('id' , auth()->user()->id)->update([ 
                   'password' => Hash::make($request->new_password)
               ]);
    
               return response()->json(["status" => true , "msg" => "Password Update Successfully"]);
           }else{

              return response()->json(["status" => false , "msg" => "Something Went Wrong" , "error" => "Old Password Did Not Match"]);
           }


        }catch(\Exception $e){

            return response()->json(["status" => false , "msg" => "Something Went Wrong" , "error" => $e->getMessage()]);
        
        }
    }

}
