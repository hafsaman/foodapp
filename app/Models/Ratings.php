<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Ratings extends Model
{
    use HasFactory;
     protected $table='ratings';
     protected $appends = ['user_data'];
    protected $fillable = [
        'id',  'user_id','rate_id','rate','status','commment'
    ];

     public function getUserDataAttribute(){

        return User::where('id',$this->user_id)->first();
    }
}
