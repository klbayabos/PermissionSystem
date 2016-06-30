<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request', function (Blueprint $table) {
            $table->increments('request_id');
            $table->integer('id');
            $table->string('type');
			$table->date('starting_date');
			$table->date('end_date');
			$table->time('starting_time');
			$table->time('end_time');
			$table->integer('status');
            $table->timestamps();
        });
		Schema::table('request', function($table){
			$table->foreign('id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('status')->references('state_id')->on('state')->onDelete('cascade')->onUpdate('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('request');
    }
}
