<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddedPost extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
         Schema::create('posts', function (Blueprint $table) {
           
           
            $table->bigIncrements('id');
            $table->string('title',500)->nullable();
            $table->string('comment')->nullable();
            $table->string('media_path',500)->nullable();
            $table->integer('user_id')->nullable();
            $table->enum('is_shopping',['yes', 'no'])->default('no');
            $table->double('price')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
