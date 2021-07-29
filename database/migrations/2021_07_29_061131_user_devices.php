<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserDevices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::table('users', function (Blueprint $table) {
           $table->enum('device_type',['ios', 'android'])->default('ios')->after('region');
           
           $table->enum('login_type',['apple', 'google','normal'])->default('normal')->after('device_type')->nullable();
            $table->string('social_id')->after('login_type')->nullable();
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('users', function (Blueprint $table) {
                
                 $table->dropColumn('device_type');
                $table->dropColumn('login_type');
               
            //
        });
    }
}
