<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ratings extends Model
{
    use HasFactory;
     protected $table='ratings';
    protected $fillable = [
        'id',  'user_id','rate_id','rate','status'
    ];
}
