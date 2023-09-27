<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    public function getDashboard(){
        return view('dashboard');
    }
}
