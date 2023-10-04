<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Billing;
class UserDashboardController extends Controller
{
    public function getDashboard(){

        $totalOrders = Billing::where('sender_id' , auth()->user()->id)->count();

        return view('dashboard')->with(['totalOrders' => $totalOrders]);
    }
}
