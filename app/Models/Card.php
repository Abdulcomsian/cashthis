<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{User , Percentage};
class Card extends Model
{
    use HasFactory;

    protected $table = 'selling_card';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id' , 'percentage_id' , 'transaction_id' , 'status' , 'email' , 'amount' ];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }

    public function percentage(){
        return $this->belongsTo(Percentage::class , 'percentage_id' , 'id');
    }
}
