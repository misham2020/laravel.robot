<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersPayments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('made_user_id')->unsigned();
            $table->integer('receive_user_id')->unsigned();
            $table->integer('flags_id')->unsigned();
            $table->decimal('amount')->unsigned();
            $table->dateTime('transfer_time');
            $table->timestamps();

            $table->foreign('flags_id')->references('id')->on('flags');
            $table->foreign('made_user_id')->references('id')->on('users');
            $table->foreign('receive_user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_payments');
    }
}
