<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Posts;

class UserNotification extends Model
{
    use HasFactory;

     protected $table='user_notification';
     protected $appends = ['notificationsend_userdata','post_data', 'notificationget_userdata'];
    protected $fillable = [
        'id',  'user_id','description','status','postlikeby_userid','post_id'
    ];

    
    public function getNotificationsendUserdataAttribute(){

        return User::where('id',$this->postlikeby_userid)->first();
    }

    public function getNotificationgetUserdataAttribute(){

        return User::where('id',$this->user_id)->first();
    }

    public function getPostDataAttribute(){

        return Posts::where('id',$this->post_id)->first();
    }

}
