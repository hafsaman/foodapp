<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGallary extends Model
{
    use HasFactory;
     protected $table='user_gallary';
    protected $fillable = [
        'id',  'title',  'link','user_id','media_type'
    ];
}
