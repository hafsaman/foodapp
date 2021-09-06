<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Posts_Gallary;

class Posts extends Model
{
    use HasFactory;
     protected $table='posts';
     protected $appends = ['post_gallary'];
    protected $fillable = [
        'id',  'title',  'media_path','user_id','comment','is_shopping','price','region'
    ];

     public function getPostGallaryAttribute(){

        return Posts_Gallary::where('post_id',$this->post_id)->get();
    }
}
