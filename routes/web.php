<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{GiftcardController, HomeController , PasscodeController, UserDashboardController};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();


Route::get('/', [HomeController::class , 'commingSoon']);
Route::get('comming-soon', [HomeController::class , 'commingSoon'])->name('commingSoon');
Route::post('set-passcode' , [PasscodeController::class , 'setPasscode'])->name('set.passcode');
Route::get('login', [HomeController::class , 'login'])->name('login');
Route::get('signup', [HomeController::class , 'register'])->name('register');


Route::group(['middleware' => ['check.passcode']] , function(){

    Route::get('home', [HomeController::class , 'home'])->name('home');
    Route::get('gurantee', [HomeController::class , 'gurantee'])->name('gurantee');
    Route::get('condition-of-use', [HomeController::class , 'condition'])->name('useCondition');
    Route::get('contact', [HomeController::class , 'contact'])->name('contact');
    Route::get('privacy-policy', [HomeController::class , 'policy'])->name('policy');
    Route::get('sell-card', [HomeController::class , 'card'])->name('card');
    Route::get('forget-password', [HomeController::class , 'forgetPassword'])->name('forgetPassword');

    
});
Route::get('view-token' , [GiftcardController::class ,'viewTokenDetail']);

Route::get('user-dashboard' , [UserDashboardController::class , 'getDashboard']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
