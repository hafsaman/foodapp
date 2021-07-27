<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts_Likes extends Model
{
    use HasFactory;
     protected $table='posts_likes';
    protected $fillable = [
        'id',  'user_id','post_id','like'
    ];
}
