<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNotificationFieldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

          Schema::table('user_notification', function (Blueprint $table) {
             $table->bigInteger('postlikeby_userid')->unsigned();
             $table->bigInteger('post_id')->unsigned();
             
            
        });
       
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

          Schema::table('user_notification', function (Blueprint $table) {

          });
    }
}
