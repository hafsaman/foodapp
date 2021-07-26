<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserProfileRegion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
           
        $table->string('region')->after('status')->nullable();
        $table->string('country')->after('region')->nullable();
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
                
                $table->dropColumn('city');
                $table->dropColumn('state');
                $table->dropColumn('region');
                $table->dropColumn('country');
            //
        });
    }
}
