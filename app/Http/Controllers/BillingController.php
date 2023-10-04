<?php

namespace App\Http\Controllers;

use App\Http\AppConst;
use Illuminate\Http\Request;
use App\Http\Traits\ReloadyApi;
use Stripe\StripeClient;
use Stripe\Exception\CardException;
use GuzzleHttp\Client;
use App\Models\{Billing};


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
            $request->validate([
                "product_id" => "required|numeric",
                "sender_name" => "required|string",
                "quantity" => "required|numeric|min:1",
                "product_amount" => "required|numeric",
                "email" => "required|email",
                "country_code" => "required|string",
                "payment_method" => "required|string"
            ]);

            $stripe = new StripeClient(env('STRIPE_SECRET'));

            $stripe = $stripe->paymentIntents->create([
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

            if($stripe->status === "succeeded"){
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

            $response = $client->post($url , [
                            "json" => $payload,
                            "headers" => $headers,
                        ]);



          $data = json_decode($response->getBody()->getContents());

          if($data->status == "SUCCESSFUL"){
            Billing::create([
                "product_id" => $request->product_id, 
                "status" => AppConst::COMMPLETED, 
                "recipient_email" => $request->email, 
                "recipient_phone" => $request->phone , 
                "recipient_country_code" => $request->country_code, 
                "quantity" => $request->quantity , 
                "unit_price" => $request->product_amount,
                "sender_id" => auth()->user()->id,
                "payed_amount" => $request->product_amount * $request->quantity
            ]);
          }else{
            Billing::create([
                "product_id" => $request->product_id, 
                "status" => AppConst::PENDING, 
                "recipient_email" => $request->email, 
                "recipient_phone" => $request->phone , 
                "recipient_country_code" => $request->country_code, 
                "quantity" => $request->quantity , 
                "unit_price" => $request->product_amount,
                "sender_id" => auth()->user()->id,
                "payed_amount" => $request->product_amount * $request->quantity
            ]);
          }

          return redirect()->route('successPurchase');

        }else{
            return redirect()->back()->with(['status' => false , 'error' => 'Something went wrong while processing payment']);
        }

            

        } catch (CardException $th) {
            return redirect()->back()->with(['status'=> false , 'error' => $th->getError()]);
        }
    }


    public function getSuccessPurchase(){
        return view('success-purchase');
    }   
}
