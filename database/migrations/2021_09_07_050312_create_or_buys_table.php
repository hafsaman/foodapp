<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrBuysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('or_buys', function (Blueprint $table) {
            $table->id();
            $table->string('at_the_farm',255)->nullable();
            $table->string('remote_delivery',255)->nullable();
            $table->string('market',255)->nullable();
            $table->string('other',255)->nullable();
            $table->integer('user_id')->nullable();
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
        Schema::dropIfExists('or_buys');
    }
}
