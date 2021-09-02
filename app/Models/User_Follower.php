<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Follower extends Model
{
    use HasFactory;
     protected $table='user_follower';
    protected $fillable = [
        'id',  'user_id','follower_id','follow'
    ];   

	public function userdatafollowing()
	{
	    return $this->hasOne('App\Models\User', 'id', 'follower_id');
	}

	  public function userdatafollower()
	{
	    return $this->hasOne('App\Models\User', 'id', 'user_id');
	}
}
