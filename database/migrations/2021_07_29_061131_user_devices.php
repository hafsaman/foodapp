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
            $table->string('devicetoken')->after('social_id')->nullable();
            $table->string('phoneno')->after('devicetoken')->nullable();
            $table->string('google_id')->after('phoneno')->nullable();
            $table->string('apple_id')->after('google_id')->nullable();

      
           
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
                 $table->dropColumn('social_id');
                  $table->dropColumn('devicetoken');
                   $table->dropColumn('phoneno');
                    $table->dropColumn('google_id');
                     $table->dropColumn('apple_id');
               
            //
        });
    }
}
