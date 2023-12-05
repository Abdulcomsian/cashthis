<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{BankInformationController, GiftcardController, HomeController, PasscodeController, UserDashboardController, BillingController, CardController};

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

// Route::get('/', [HomeController::class, 'commingSoon']);
Route::get('comming-soon', [HomeController::class, 'commingSoon'])->name('commingSoon');
Route::post('set-passcode', [PasscodeController::class, 'setPasscode'])->name('set.passcode');
Route::get('login', [HomeController::class, 'login'])->name('login');
Route::get('signup', [HomeController::class, 'register'])->name('register');
Route::get('forget-password', [HomeController::class , 'forgetPassword'])->name('forgetPassword');
Route::get('aboutUs', [HomeController::class , 'aboutUs'])->name('aboutUs');

Route::get('/', [HomeController::class, 'index']);
Route::get('home', [HomeController::class, 'index'])->name('home');
Route::get('gurantee', [HomeController::class, 'gurantee'])->name('gurantee');
Route::get('condition-of-use', [HomeController::class, 'condition'])->name('useCondition');
Route::get('privacy-policy', [HomeController::class, 'policy'])->name('policy');

// Route::group(['middleware' => ['check.passcode']], function () {
//     Route::get('home', [HomeController::class, 'home'])->name('home');
//     Route::get('gurantee', [HomeController::class, 'gurantee'])->name('gurantee');
//     Route::get('condition-of-use', [HomeController::class, 'condition'])->name('useCondition');
   
//     Route::get('privacy-policy', [HomeController::class, 'policy'])->name('policy');
    
// });
 Route::get('contact', [HomeController::class, 'contact'])->name('contact');
 Route::post('contactform', [HomeController::class, 'contactform'])->name('contactform');
Route::get('forget-password', [HomeController::class, 'forgetPassword'])->name('forgetPassword');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/user-card', [GiftcardController::class, 'giftCardPage'])->name('giftCardPage');
Route::post('get-gift-card', [GiftcardController::class, 'getGiftCards'])->name('getGiftCard');

Route::group(['middleware' => ['auth']], function () {
    Route::get('user-dashboard', [UserDashboardController::class, 'getDashboard'])->name('userDashboard');
    Route::get('gift-card-detail/{productId}', [GiftCardController::class, 'giftCardDetail'])->name('giftCardDetail');
    Route::post('purchase-card', [BillingController::class, 'purchaseCard'])->name('purchaseGiftCard');
    Route::post('buy-card', [BillingController::class, 'buyCard'])->name('buyGiftCard');
    Route::get('success-purchase', [BillingController::class, 'getSuccessPurchase'])->name('successPurchase');
    Route::get('orders', [GiftcardController::class, 'getOrdersPage'])->name('orders');
    Route::post('orders-list', [GiftcardController::class, 'getOrdersList'])->name('ordersList');
    Route::get('bank-information' , [BankInformationController::class , 'bankInformation'])->name('bankInformation');
    Route::post('add-bank-information' , [BankInformationController::class , 'addBankInformation'])->name('addBankInformation');
    Route::post('update-user-profile', [UserDashboardController::class , 'updateUserProfile'])->name('updateUserProfile');
    Route::post('update-user-password', [UserDashboardController::class , 'updateUserPassword'])->name('updateUserPassword');
    // Route::get('sell-card', [CardController::class, 'card'])->name('card');
    // Route::post('add-sell-card-information', [CardController::class, 'addUserCard'])->name('addUserCard');
    //paypal route starts here
    Route::get('sell-card', [CardController::class, 'card'])->name('card');
    Route::post('add-sell-card-information', [CardController::class, 'addUserCard'])->name('addUserCard');
    // Route::post('create-paypal-transaction', [CardController::class, 'createPaypalTransaction'])->name('createPaypalTransaction');
    Route::any('success-transaction' , [CardController::class , 'successTransaction'])->name('successTransaction');
    Route::post('user-sold-card' , [CardController::class , 'getSoldCard'])->name('getSoldCard');
    Route::post('update-percentage' , [CardController::class ,'updatePercentage'])->name('updatePercentage');
    //paypal route ends here
    Route::get('get-profile-detail' , [UserDashboardController::class ,'getProfileDetail'])->name('getProfileDetail');
    
    

});
// mailchimp subscribe route
Route::post('/subscribe', [HomeController::class, 'subscribe'])->name('subscribe.user');
Route::group(['middleware' => ['auth' , 'check.admin']] , function(){
    Route::get('card-list' , [CardController::class , 'cardList'])->name('cardList');
    Route::get('user-list' , [HomeController::class , 'userList'])->name('userList');
    Route::post('users' , [HomeController::class , 'getUsers'])->name('users');
    Route::post('delete-user' , [HomeController::class , 'deleteUser'])->name('deleteUser');
    Route::post('selling-card-list' , [CardController::class , 'getSellingCards'])->name('sellingCards');
    Route::post('get-user-bank-details' , [BankInformationController::class , 'getBankDetails'])->name('bankDetails');
    Route::post('get-card-status' , [CardController::class ,'getCardStatus'])->name('getCardStatus');
    Route::post("update-card-status" , [CardController::class , 'updateCardStatus'])->name('updateCardStatus');
});
