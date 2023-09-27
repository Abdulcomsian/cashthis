<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){

        return view('index');
    
    }

    public function gurantee(){
        
        return view('gurantee');

    } 

    public function condition(){

        return view('condition-of-use');

    }

    public function contact(){
       
        return view('contact');
        
    }

    public function policy(){

        return view('privacy-policy');

    }

    public function card(){

        return view('sell-card');

    }

    public function forgetPassword(){

        return view('forget-password');

    }

    public function login(){

        return view('login');

    }

    public function register(){

        return view('signup');

    }


    public function commingSoon(){

        return view('comming-soon');

    }



}
