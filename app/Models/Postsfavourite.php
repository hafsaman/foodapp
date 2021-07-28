<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Postsfavourite extends Model
{
    use HasFactory;
    protected $table='posts_favourite';
    protected $fillable = [
        'id',  'user_id','post_id','favourite'
    ];
}
