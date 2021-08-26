<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLabels extends Model
{
    use HasFactory;
     protected $table='user_labels';
    protected $fillable = [
        'id',  'user_id','label_id','status'
    ];
}
