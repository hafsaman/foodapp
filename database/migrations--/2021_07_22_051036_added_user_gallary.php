<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedUserGallary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_gallary', function (Blueprint $table) {
           
           
            $table->bigIncrements('id');
            $table->string('title',100)->nullable();
            $table->string('link',500)->nullable();
            $table->integer('user_id')->nullable();
            $table->string('media_type')->nullable();
            $table->boolean('status')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('user_gallary');
    }
}
