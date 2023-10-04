<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

   protected $table = "billing";
   protected $primaryKey = "id";
   protected $fillable = [ "product_id" , "status" , "recipient_email" , "recipient_phone" , "recipient_country_code" , "quantity" , "unit_price" , "sender_id" , "payed_amount" ];
}
