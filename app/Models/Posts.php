<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Posts_Gallary;
use App\Models\Region;
use App\Models\User;
use Auth;

class Posts extends Model
{
    use HasFactory;
     protected $table='posts';
     protected $appends = ['media_path','region_data','distance'];
    protected $fillable = [
        'id',  'title',  'media_path','user_id','comment','is_shopping','price','region','seasonal','unit'
    ];

     public function getMediaPathAttribute(){

        return Posts_Gallary::where('post_id',$this->id)->select('media_path','media_type')->get();
    }

    public function user_data(){
    	return $this->hasOne('App\Models\User', 'id', 'user_id');
    }

    public function getRegionDataAttribute(){
        return Region::where('region',$this->region)->first();
    }

      public function getDistanceAttribute(){

        $user_id = Auth::id();
        $profile_user = User::where('id',$user_id)->first();
        $post_user = User::where('id',$this->user_id)->first();
        $profile_user_region = Region::where('region',$profile_user->region)->first();
        $post_user_region = Region::where('region',$post_user->region)->first();
        return Region::select(DB::raw($this->distance($profile_user_region->latitude, $profile_user_region->longitude,'distance'))) 
                ->where('id',$post_user_region->id)
                ->first(); 
    }
     function distance($lat,$long,$name)
        {
            //this distance is finded in KM
            return "ROUND(6371 * acos(cos(radians(" . $lat . "))
                    * cos(radians(latitude))
                    * cos(radians(longitude) - radians(" . $long . "))
                    + sin(radians(" .$lat. "))
                    * sin(radians(latitude))),2) AS ".$name;
        }
     
}
