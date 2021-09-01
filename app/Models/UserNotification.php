<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model
{
    use HasFactory;
     protected $table='user_notification';
    protected $fillable = [
        'id',  'user_id','description','status','postlikeby_userid','post_id'
    ];
}
