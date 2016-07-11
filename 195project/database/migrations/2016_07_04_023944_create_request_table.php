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
			$table->engine = 'InnoDB';
            $table->increments('request_id');
            $table->integer('id')->unsigned();
            $table->string('type');
            $table->integer('process_id')->unsigned();
            $table->integer('team_id')->unsigned();
			$table->date('starting_date');
			$table->date('end_date');
			$table->time('starting_time');
			$table->time('end_time');
			$table->text('request_purpose');
			$table->integer('status')->unsigned();
			$table->text('approved_dates')->nullable();
            $table->timestamps();
        });
		Schema::table('request', function($table){
			$table->foreign('id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('status')->references('state_id')->on('state')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('team_id')->references('team_id')->on('users')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('process_id')->references('process_id')->on('process')->onDelete('cascade')->onUpdate('cascade');
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
