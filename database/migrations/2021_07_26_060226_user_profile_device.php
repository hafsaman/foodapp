<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserProfileDevice extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
           $table->string('devicetype')->after('region')->nullable();
           $table->string('logintype')->after('devicetype')->nullable();
           $table->string('devicetoken')->after('logintype')->nullable();
        $table->string('phoneno')->after('devicetoken')->nullable();
       
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('users', function (Blueprint $table) {
                
                $table->dropColumn('phoneno');
                $table->dropColumn('devicetype');
                $table->dropColumn('logintype');
                $table->dropColumn('devicetoken');
               
            //
        });
    }
}
