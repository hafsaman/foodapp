<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts_Comments extends Model
{
    use HasFactory;
     protected $table='posts_comments';
    protected $fillable = [
        'id',  'user_id','post_id','comment'
    ];
}
