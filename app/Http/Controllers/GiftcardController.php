<?php

namespace App\Http\Controllers;

use App\Http\AppConst;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Traits\ReloadyApi;
use App\Models\{ Country , User};
use Yajra\DataTables\Facades\DataTables;
class GiftcardController extends Controller
{
    use ReloadyApi;

    protected $token = null;

    function __construct()
    {
        $this->token = $this->createToken();
    } 

   public function giftCardPage(){
        
        $countries = Country::orderBy('country_name' , 'asc')->get();
        return view('cards')->with(['countries' => $countries]);
   }

    public function getGiftCards(Request $request){
        try{
            $client = new Client();
            $isoCode = $request->iso;
            $url = 'https://giftcards-sandbox.reloadly.com/countries/'.$isoCode.'/products';
            $headers = [
                "Accept" => "application/com.reloadly.giftcards-v1+json",
                "Authorization" =>  "Bearer ".$this->token
            ];

            $response = $client->get($url , [
                'headers' => $headers
            ]);
    
            $giftCards = json_decode($response->getBody()->getContents());
    
            $cards = [];

            foreach($giftCards as $card)
            {
                $cards[] = ["product_id" => $card->productId , "country_iso" => $card->country->isoName , "brand" => $card->brand->brandName , "logo_url" => is_array($card->logoUrls) && sizeof($card->logoUrls) > 0 ?  $card->logoUrls[0] : null ] ;
            }

            return response()->json(["status" => true , "cards" => $cards]);
            
        }catch(\Exception $e){
            return response()->json(['status' => false , 'error' => $e->getMessage() , 'msg' => 'Something Went Wrong']);
        }
        
        
    }
    
    public function giftCardDetail(Request $request , $productId){
        try{
            $client = new Client();
            $url = "https://giftcards-sandbox.reloadly.com/products/".$productId;
            $headers = [
                "Accept" => "application/com.reloadly.giftcards-v1+json",
                "Authorization" =>  "Bearer ".$this->token
            ];
            
            $response = $client->get($url , [
                'headers' => $headers
            ]);
            
            $giftCardDetail = json_decode($response->getBody()->getContents());

            $countries = Country::orderBy('country_name' , 'asc')->get();

            
            // dd($giftCardDetail);
            return view('gift-card-detail')->with(['cardDetail' => $giftCardDetail , 'countries' => $countries]);


        }catch(\Exception $e){
            return response()->json(['status' => false , 'error' => $e->getMessage() , 'msg' => 'Something Went Wrong' ]);
        }
    }


    public function getOrdersPage(){
        return view('orders');
    }

    public function getOrdersList(){

        $user = User::with('orders')->where('id' , auth()->user()->id)->first();
        $orders = $user->orders;

        return DataTables::of($orders)
                        ->addIndexColumn()
                        ->addColumn('orderId' , function($order){
                            return $order->id;
                        })
                        ->addColumn('card' , function($order){
                            return $order->product_title;
                        })
                        ->addColumn('recipientEmail' , function($order){
                            return $order->recipient_email;
                        })
                        ->addColumn('recipientPhone' , function($order){
                            return $order->recipient_phone;
                        })
                        ->addColumn('quantity' , function($order){
                            return $order->quantity;
                        })
                        ->addColumn('unitPrice' , function($order){
                            return $order->unit_price;
                        })
                        ->addColumn('purchaseDate' , function($order){
                            return $order->created_at;
                        })
                        ->addColumn('status' , function($order){
                            return $order->status == AppConst::COMPLETED ? 'COMPLETED' : 'PENDING';
                        })

                        ->rawColumns(['orderId' , 'card' , 'recipientEmail' , 'recipientPhone' ,'quantity' , 'unitPrice' , 'purchaseDate'])
                        ->make(true);
    }


}
