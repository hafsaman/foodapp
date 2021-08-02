<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts_Gallary extends Model
{
    use HasFactory;
     protected $table='post_gallary';
    protected $fillable = [
        'id', 'media_path','post_id','media_type'
    ];
}
