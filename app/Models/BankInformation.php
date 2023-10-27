<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class BankInformation extends Model
{
    use HasFactory;

    protected $table = 'bank_card_information';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id' , 'name' , 'routing_number' , 'account_number' , 'account_name'];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }



}
