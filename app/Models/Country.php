<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $table = 'countries';
    protected $fillable = ["iso_name", "country_name" , "currency_code", "currency_name" ,"currency_flag_url"];
    
}
