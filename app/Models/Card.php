<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = 'selling_card';

    protected $primaryKey = 'id';

    protected $fillable = ['user_id' , 'transaction_id' , 'status' , 'email' , 'amount' ];

    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
}
