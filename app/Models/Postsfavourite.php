<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Posts;

class Postsfavourite extends Model
{
    use HasFactory;
    protected $table='posts_favourite';
    protected $appends = ['post_data'];
    protected $fillable = [
        'id',  'user_id','post_id','favourite'
    ];

     public function getPostDataAttribute(){

        return Posts::where('id',$this->post_id)->first();
    }


}
