<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{ Card };

class Percentage extends Model
{
    use HasFactory;

    protected $table = "selling_percentage";
    protected $primaryKey = 'id';
    protected $fillable = ["percentage"];

    public function cards(){
        return $this->hasMany(Card::class , 'percentage_id' , 'id');
    }


}
