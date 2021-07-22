<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    use HasFactory;
     protected $table='posts';
    protected $fillable = [
        'id',  'title',  'media_path','user_id','comment','is_shopping','price'
    ];
}
