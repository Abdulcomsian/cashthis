<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Http\Traits\ReloadyApi;
use GuzzleHttp\Client;
use App\Models\Country;

class CountryIsoSeeder extends Seeder
{
    use ReloadyApi;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::truncate();
        try{
            $token = $this->createToken();
            $client = new Client();
    
            $url = "https://giftcards-sandbox.reloadly.com/countries";
            $headers = [
                "Accept" => "application/com.reloadly.giftcards-v1+json",
                "Authorization" => "Bearer " . $token,
            ];
    
            $response = $client->get($url, [
                'headers' => $headers,
            ]);
    
            $countries = json_decode($response->getBody()->getContents());
    
            $countriesList = [];
            foreach($countries as $country){
                if(isset($country->isoName) && !empty(trim($country->isoName)) && !is_null($country->isoName)){
                    $countriesList[] = [
                        "iso_name" => $country->isoName,
                        "country_name" => $country->name,
                        "currency_code" => $country->currencyCode,
                        "currency_name" => $country->currencyName,
                        "currency_flag_url"=> $country->flagUrl
                    ];
                }
            }
    
    
            Country::insert($countriesList);

        }catch(\Exception $e){
            dd($e->getMessage());
        }

    }
}
