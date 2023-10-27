<?php

namespace App\Http\Controllers;

use App\Http\AppConst;
use Illuminate\Http\Request;
use App\Models\{ User , Card };
use Carbon\Carbon;
use Srmklive\PayPal\Services\PayPal;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Type\TrueType;

class CardController extends Controller
{
    public function card()
    {
       $user =  User::with('bankDetails')->where('id' , auth()->user()->id)->first();

       if($user->bankDetails){
           return view('sell-card');
       }else{
           return view('bank-information');
       }
    }

    public function createPaypalTransaction(Request $request){
        $request->validate(['amount' => 'required|numeric']);
        
        $provider = new PayPal;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();
        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('successTransaction'),
                "cancel_url" => route('cancelTransaction'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $request->amount,
                    ],
                    "funding" =>  [
                        "allowed" => "paypal.FUNDING.CARD",
                        "disallowed" => "paypal.FUNDING.CREDIT"
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            // redirect to approve href
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()->route('sell-card')->with(['error' => 'Something went wrong.' ]);
        } else {
            return redirect()->route('sell-card')->with(['error'=> $response['message'] ?? 'Something went wrong.']);
        }
    }

    public function successTransaction(Request $request){
        try{
            
            $validator = Validator::make($request->all() , [
                'id' => 'required',
                'payerEmail' => 'required|email',
                'payedAmount' => 'required|numeric'  
            ]);

            if($validator->fails()){
                return response()->json(['status' => false , 'msg' => 'Something Went Wrong' , 'error' => $validator->getMessageBag() ]);
            }else{

                Card::create([
                    'user_id' => auth()->user()->id,
                    'transaction_id' => $request->id,
                    'status' => AppConst::PENDING,
                    'email' => $request->payerEmail,
                    'amount' => $request->payedAmount
                ]);

                return response()->json(['status' => true , 'msg' => 'Transaction Added Successfully' ]);

            }

        }catch(\Exception $e){
            return response()->json(['status' => false , 'msg' => 'Something Went Wrong' , 'error' => $e->getMessage() ]);
        }

        
    }

    public function addUserCard(Request $request){

        // $request->validate([
        //     'card_number' => 'required|string',
        //     'expiry_month' => 'required|min:1',
        //     'expiry_year' => 'required',
        //     'security_code' => 'required|string',
        //     'bank_card_detail' => 'string',
        // ]);


        // try{
    
        //     $currentDate = Carbon::now()->addDay(30);
        //     $givenDate = Carbon::create((int)"20".$request->expiry_year, (int)$request->expiry_month,  1, 0, 0, 0);
        //     $check = $givenDate->greaterThanOrEqualTo($currentDate);
        //     if($check)
        //     {
        //         Card::create([
        //             'user_id' => auth()->user()->id,
        //             'card_number' => $request->card_number,
        //             'expiry_month' => $request->expiry_month,
        //             'expiry_year' => $request->expiry_year,
        //             'security_code' => $request->security_code,
        //             'bank_card_detail' => $request->detail,
        //         ]);

        //         return redirect()->back()->with(['status' => true  , 'msg' => 'Thanks For Adding Card, Your Card Is Processing We Contact You Soon']);
        //     }else{
        //         return redirect()->back()->with(['status' => false  , 'error' => 'Card Expiration Date Must Be Greater Then At Least One Month']);
        //     }


        // }catch(\Exception $e){
        //     return redirect()->back()->with(['status' => false , 'error' => $e->getMessage() ]);
        // }
    }

    // public function successTransaction(Request $request){
    //     $provider = new PayPal;
    //     $provider->setApiCredentials(config('paypal'));
    //     $provider->getAccessToken();
    //     $response = $provider->capturePaymentOrder($request['token']);
    //     if (isset($response['status']) && $response['status'] == 'COMPLETED') {
    //         return redirect()
    //             ->route('sell-card')
    //             ->with(['success' =>  'Transaction complete.']);
    //     } else {
    //         return redirect()
    //             ->route('sell-card')
    //             ->with(['error'=> $response['message'] ?? 'Something went wrong.']);
    //     }
    // }

    // public function cancelTransaction(Request $request){
    //     return redirect()->route('createTransaction')->with('error', $response['message'] ?? 'You have canceled the transaction.');
    // }
}



