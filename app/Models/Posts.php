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

   
}
