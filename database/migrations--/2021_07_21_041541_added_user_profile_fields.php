<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedUserProfileFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
             $table->text('avatar')->after('password')->nullable();
        $table->text('about')->after('avatar')->nullable();
        $table->boolean('status')->default('1')->after('about');
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
                $table->dropColumn('avatar');
                $table->dropColumn('about');
                $table->dropColumn('status');
                $table->dropColumn('city');
                $table->dropColumn('state');
            //
        });
    }
}
