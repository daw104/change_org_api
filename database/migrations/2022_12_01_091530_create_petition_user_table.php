<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('petition_user', function (Blueprint $table) {
            $table->primary(['user_id','petition_id']);
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('petition_id')->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users'); //referencia fk a la tabla users
            $table->foreign('petition_id')->references('id')->on('petitions'); //referencia fk a la tabla petitions
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('petition_user');
    }
};
