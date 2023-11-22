<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\contactUsNotification;
// use Spatie\Newsletter\Facades\Newsletter;
use Newsletter;

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



    
}