<?php 

namespace App\Http\Traits;
use GuzzleHttp\Client;

trait ReloadyApi{

    public function createToken(){

        $client = new Client();
        $url = "https://auth.reloadly.com/oauth/token";
        $headers = [ "Content-Type" => "application/json"];
        $payload = [
            "client_id" => env('RELOADLY_CLIENT'),
            "client_secret" => env('RELOADLY_SECRET'),
            "grant_type" => "client_credentials",
            "audience" => "https://giftcards-sandbox.reloadly.com"
        ];
        $response = $client->post( $url , [
            'json' => $payload,
            'headers' => $headers
        ]); 

        $data = json_decode($response->getBody()->getContents());

        return $data->access_token;
    }


}