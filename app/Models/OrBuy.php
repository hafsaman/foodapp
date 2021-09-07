<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrBuy extends Model
{
    use HasFactory;

     protected $fillable = [
        'at_the_farm', 'remote_delivery', 'market','user_id','other'
     ];
}
