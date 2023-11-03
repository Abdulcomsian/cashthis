<?php

namespace App\Http\Controllers;

use App\Http\AppConst;
use Illuminate\Http\Request;
use App\Models\{ User , Card };
use Carbon\Carbon;
use Srmklive\PayPal\Services\PayPal;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\Type\TrueType;
use Yajra\DataTables\Facades\DataTables;

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

    public function getSellingCards(Request $request){
        $cards = Card::with('user')->orderBy('id' , 'desc')->get();
        
        return DataTables::of($cards)
                ->addIndexColumn()
                ->addColumn('username' , function($card){
                    return $card->user->first_name.' '.$card->user->last_name;
                })
                ->addColumn('email' , function($card){
                    return $card->user->email;
                })
                ->addColumn('transaction_id' , function($card){
                    return $card->transaction_id;
                })
                ->addColumn('payer_email' , function($card){
                    return $card->email;
                })
                ->addColumn('amount' , function($card){
                    return "$".$card->amount;
                })
                ->addColumn('status' , function($card){
                    return $card->status == AppConst::PENDING ? "PENDING" : "COMPLETED" ;
                })
                
                ->addColumn('action' , function($card){
                    return '<div class="d-flex text-center"><i class="fas fa-info-circle bank-detail-btn mx-3" title="view bank detail" data-user-id="'.$card->user->id.'"></i><i class="fas fa-pen-square card-status-btn" data-card-id="'.$card->id.'"></i></div>';
                })
                ->rawColumns(['username' , 'email' , 'transaction_id' , 'payer_email' , 'amount' , 'status' , 'action'])
                ->make(true);
    }

    public function cardList(){
        return view('card-list');
    }

    public function getCardStatus(Request $request){
        try{
            $validator = Validator::make($request->all() , [
                'id' => 'required|numeric' 
            ]);

            if($validator->fails()){
                return response()->json(['status' => false , 'msg' => "Something Went Wrong" , "error" => $validator->getMessageBag()]);
            }else{
                $card  = Card::where('id' , $request->id)->first();
                $html = view('ajax.card-status-change' , ['card' => $card])->render();
                return response()->json(['status' => true , 'html' => $html]);
            }
        }catch(\Exception $e){
            return response()->json(['status' => false , 'msg' => "Something Went Wrong" , "error" => $e->getMessage()]);
        }
    }

    public function updateCardStatus(Request $request){
        try{
            $validator = Validator::make($request->all() , [
                'id' => 'required|numeric',
                'status' => 'required|numeric',
            ]);

            if($validator->fails()){
                return response()->json(['status' => false , 'msg' => "Something Went Wrong" , "error" => $validator->getMessageBag()]);
            }else{
                Card::where('id' , $request->id)->update(['status' => $request->status]);
                return response()->json(['status' => true , 'msg' => "Card Status Updated Successfully"]);
            }
        }catch(\Exception $e){
            return response()->json(['status' => false , 'msg' => "Something Went Wrong" , "error" => $e->getMessage()]);
        }
    }

    public function getSoldCard(){
        try{
            $cards = Card::where('id' , auth()->user()->id)->orderBy('id','desc')->get();
            return DataTables::of($cards)
                            ->addIndexColumn()
                            ->addColumn( 'transaction_id' , function($card){
                                return $card->transaction_id;
                            })
                            ->addColumn('email', function($card){
                                return $card->email;
                            })
                            ->addColumn('amount', function($card){
                                return "$".$card->amount;
                            })
                            ->addColumn('status', function($card){
                                return $card->status == AppConst::PENDING ? 'PENDING' : 'COMPLETED' ;
                            })
                            ->rawColumns(['transaction_id' , 'email' , 'amount' , 'status'])
                            ->make(true);

        }catch(\Exception $e){
            return response()->json(['status' => false , 'msg' => "Something Went Wrong" , "error" => $e->getMessage()]);
        }
    }

}



