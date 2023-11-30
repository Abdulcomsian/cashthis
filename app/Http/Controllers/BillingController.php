<?php

namespace App\Http\Controllers;

use App\Http\AppConst;
use Illuminate\Http\Request;
use App\Http\Traits\ReloadyApi;
use Stripe\StripeClient;
use Stripe\Exception\CardException;
use GuzzleHttp\Client;
use App\Models\{Billing};
use GuzzleHttp\Exception\ClientException;
use Illuminate\Support\Facades\DB;

class BillingController extends Controller
{

    use ReloadyApi;

    protected $token;

    function __construct()
    {
        $this->token = $this->createToken();
    }

    public function purchaseCard(Request $request){

        try {
            DB::beginTransaction();
            $request->validate([
                "product_id" => "required|numeric",
                "sender_name" => "required|string",
                "quantity" => "required|numeric|min:1",
                "product_amount" => "required|numeric",
                "email" => "required|email",
                "country_code" => "required|string",
                "payment_method" => "required|string",
                "product_name" => "required|string"
            ]);

            $stripe = new StripeClient(env('STRIPE_SECRET'));

            $stripeIntent = $stripe->paymentIntents->create([
                'amount' => ($request->product_amount * $request->quantity ) * 100,
                'currency' => 'usd',
                'payment_method' => $request->payment_method,
                'description' => 'Gift Card Purchase',
                'confirm' => true,
                'automatic_payment_methods' => [
                    'enabled' => true,
                    'allow_redirects' => 'never',
                ],
            ]);

          
            $intentId = $stripeIntent->id;

            if($stripeIntent->status === "succeeded")
            {

                $client = new Client();
                $url = 'https://giftcards-sandbox.reloadly.com/orders';
                
                $headers = [
                    "Accept" =>  "application/com.reloadly.giftcards-v1+json",
                    "Authorization" =>  "Bearer ".$this->token,
                    "Content-Type" => "application/json"
                ];

                $recipientPhoneDetails = [
                    "countryCode" => $request->country_code,
                    "phoneNumber" => $request->phone
                ];


                $payload = [
                    "productId" => $request->product_id,
                    "senderName" => $request->sender_name,
                    "quantity" => $request->quantity,
                    "unitPrice" => $request->product_amount,
                    "recipientEmail" => $request->email,
                    "recipientPhoneDetails"  => $recipientPhoneDetails,
                ];

        

                try{
                    $response = $client->post($url , [
                                    "json" => $payload,
                                    "headers" => $headers,
                                ]);

                                $data = json_decode($response->getBody()->getContents());
                }
                catch(ClientException $e){
                    
                    $stripe->refunds->create([
                        'payment_intent' => $intentId
                    ]);

                    $errorResponse = json_decode($e->getResponse()->getBody()->getContents());
                    $errorMsg = $errorResponse->message;
                    return redirect()->back()->with(['status' => false , 'error' => $errorMsg]);
                }



            
                Billing::create([
                    "product_id" => $request->product_id, 
                    "status" => $data->status == "SUCCESSFUL" ? AppConst::COMPLETED : AppConst::PENDING, 
                    "recipient_email" => $request->email, 
                    "recipient_phone" => $request->phone , 
                    "recipient_country_code" => $request->country_code, 
                    "quantity" => $request->quantity , 
                    "unit_price" => $request->product_amount,
                    "sender_id" => auth()->user()->id,
                    "payed_amount" => $request->product_amount * $request->quantity,
                    "product_title" => $request->product_name,
                    "transaction_id" => $stripeIntent->id,
                    "gift_transaction_id" => $data->transactionId,
                    "platform" => "RELODLY"
                ]);
            
            DB::commit();

            return redirect()->route('successPurchase');

        }else{
            DB::rollback();
            $stripe->refunds->create([
                'payment_intent' => $intentId
            ]);
            return redirect()->back()->with(['status' => false , 'error' => 'Something went wrong while processing payment']);
        }

            

        } catch (CardException $th) {
            DB::rollback();
            return redirect()->back()->with(['status'=> false , 'error' => $th->getError()]);
        }
    }


    public function buyCard(Request $request){
        $request->validate([
            "paymentId" => "required|string",
            "payerEmail"=> "required|email",
            "productAmount" => "required|numeric",
            "productId" => "required",
            "productQuantity" => "required|numeric",
            "recipientEmail" => "required|email",
            "recipientPhone" => "required|string",
            "recipientCode" => "required|string",
            "senderName" => "required|string",
            "productName" => "required|string"
        ]);


        try {
            DB::beginTransaction();

            $client = new Client();
                $url = 'https://giftcards-sandbox.reloadly.com/orders';
                
                $headers = [
                    "Accept" =>  "application/com.reloadly.giftcards-v1+json",
                    "Authorization" =>  "Bearer ".$this->token,
                    "Content-Type" => "application/json"
                ];

                $recipientPhoneDetails = [
                    "countryCode" => $request->recipientCode,
                    "phoneNumber" => $request->recipientPhone
                ];


                $payload = [
                    "productId" => $request->productId,
                    "senderName" => $request->senderName,
                    "quantity" => $request->productQuantity,
                    "unitPrice" => $request->productAmount,
                    "recipientEmail" => $request->recipientEmail,
                    "recipientPhoneDetails"  => $recipientPhoneDetails,
                ];


                try{
                    $response = $client->post($url , [
                                    "json" => $payload,
                                    "headers" => $headers,
                                ]);

                    $data = json_decode($response->getBody()->getContents());
                }
                catch(ClientException $e){
                    
                    $errorResponse = json_decode($e->getResponse()->getBody()->getContents());
                    $errorMsg = $errorResponse->message;
                    return redirect()->back()->with(['status' => false , 'error' => $errorMsg]);
                }

                Billing::create([
                    "product_id" => $request->productId, 
                    "status" => $data->status == "SUCCESSFUL" ? AppConst::COMPLETED : AppConst::PENDING, 
                    "recipient_email" => $request->recipientEmail, 
                    "recipient_phone" => $request->recipientPhone , 
                    "recipient_country_code" => $request->recipientCode, 
                    "quantity" => $request->productQuantity , 
                    "unit_price" => $request->productAmount,
                    "sender_id" => auth()->user()->id,
                    "payed_amount" => $request->productAmount * $request->productQuantity,
                    "product_title" => $request->productName,
                    "transaction_id" => $request->paymentId,
                    "gift_transaction_id" => $data->transactionId,
                    "platform" => "RELODLY"
                ]);
            
            DB::commit();
            
            return response()->json(["status" => true , "msg" => "Card Purchased Successfully" ]);
            // return redirect()->route('successPurchase');

        }catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->with(['status'=> false , 'error' => $e->getMessage()]);
        }
       
    }


    public function getSuccessPurchase(){
        return view('success-purchase');
    }   
}
