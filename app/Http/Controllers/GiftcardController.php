<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Http\Traits\ReloadyApi;

class GiftcardController extends Controller
{
    use ReloadyApi;

    protected $token = null;

    function __construct()
    {
        $this->token = $this->createToken();
    } 

    public function viewTokenDetail()
    {
        dd($this->token);
    }
}
