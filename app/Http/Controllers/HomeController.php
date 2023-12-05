<?php

namespace App\Http\Controllers;

use App\Http\AppConst;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{ Notification , Validator};
use App\Notifications\contactUsNotification;
// use Spatie\Newsletter\Facades\Newsletter;
use Newsletter;
use Yajra\DataTables\DataTables;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }
    
    public function aboutUs()
    {
        return view('about');
    }

    public function gurantee()
    {
        return view('gurantee');
    }

    public function condition()
    {
        return view('condition-of-use');
    }

    public function contact()
    {
        return view('contact');
    }

    public function contactform(Request $request){
        $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email',
                'subject' => 'required',
                'message' => 'required',
            ],[
                'first_name.required' => 'This field is required',
                'last_name.required' => 'This field is required',
                'email.required' => 'Email is required',
                'Subject.required' => 'Subject is required',
                'message.required' => 'Message is required',
            ]
        );
        $email = $request->input('email');
        $subject = $request->input('subject');
        $message = $request->input('message');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        try{
            Notification::route('mail', env('MAIL_FROM_ADDRESS'))->notify(new contactUsNotification($subject, $message, $email, $first_name, $last_name));
            return redirect()->back()->with('success', 'Your message has Sent!');
        }catch(\Exception $e){
            return redirect()->back()->with(['error'=> 'Sorry! Your message message is not delivered. Please try again later', 'error_msg'=> $e->getMessage()] );
        }
    }

    public function subscribe(Request $request){
        $request->validate([
            'email' => 'required|email',
        ],[
            'email.required' => 'Email is required',
            'email.email'    => 'Please write a valid email Address',
        ]
        );
        $email = $request->input('email');
        try{
            if(Newsletter::isSubscribed($email)){
                return redirect()->back()->with('error_subscribe', 'You have already Subscribed');
            }else{
                Newsletter::subscribe($email);
                return redirect()->back()->with('success_subscribe', 'You have successfully subscribed');
            }
        }catch(\Exception $e){
            return redirect()->back()->with('error_subscribe', $e->getMessage());
        }
    }

    public function policy()
    {
        return view('privacy-policy');
    }
    
    public function forgetPassword()
    {
        return view('forget-password');
    }

    public function login()
    {
        return view('login');
    }

    public function register()
    {
        return view('signup');
    }

    public function commingSoon()
    {
        return view('comming-soon');
    }

    public function userList(){
       
        return view('user-list');
    }

    public function getUsers(){
        $users = User::with('orders' , 'sellCards')->where('type' , AppConst::USER)->get();
        return DataTables::of($users)
                        ->addIndexColumn()
                        ->addColumn( 'username' , function($user){
                            return $user->first_name.' '.$user->last_name;
                        })
                        ->addColumn('email', function($user){
                            return $user->email;
                        })
                        ->addColumn('phone', function($user){
                            return $user->phone;
                        })
                        ->addColumn('order', function($user){
                            return '<div class="d-flex justify-content-center">'.$user->orders->count().'</div>';
                        })
                        ->addColumn('sold_card', function($user){
                                return '<div class="d-flex justify-content-center">'.$user->sellCards->count().'</div>';
                        })
                        ->addColumn('action', function($user){
                            return '<div class="d-flex justify-content-center">
                                        <i class="delete-user fas fa-trash-alt text-danger mx-2" title="Delete User" data-user-id="'.$user->id.'"></i>
                                        <i class="user-bank-detail fas fa-university text-muted mx-2" title="Bank Detail" data-user-id="'.$user->id.'"></i>
                                    <div>';
                        })
                        ->rawColumns(['username' , 'email' , 'phone' , 'order' , 'sold_card' , 'action'])
                        ->make(true);

    }


    public function deleteUser(Request $request){
        $validator = Validator::make( $request->all() , [
            'userId' => 'required|numeric',
        ]);

        if($validator->fails()){
            return response()->json(['status' => false , 'msg' => 'Something Went Wrong' , 'error' => $validator->getMessageBag()  ]);
        }

        $id = $request->userId;
        User::where('id' , $id)->delete();
        return response()->json(['status' => true , 'msg' => 'User Deleted Successfully' ]);
    }


}