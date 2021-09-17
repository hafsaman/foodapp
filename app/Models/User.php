<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use App\Models\Ratings;
use App\Models\Region;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $appends = ['ratings','region_data'];
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'about',
        'status',
        'region',
        'phoneno',
        'login_type',
        'device_type','devicetoken','social_id','google_id','apple_id','set_notifications_send'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    
        public function followdata()
        {
            return $this->hasMany('App\Models\User_Follower', 'user_id', 'id');
        }

        public function following_data()
        {
            return $this->hasMany('App\Models\User_Follower', 'follower_id', 'id');
        }

        public function getRatingsAttribute()
        {
            return Ratings::where('user_id',$this->id)->avg('rate');
        }
        public function getRegionDataAttribute(){
            return Region::where('region',$this->region)->first();
        }

      
    
}
