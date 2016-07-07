<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('request_action', function(Blueprint $table){
			$table->engine = 'InnoDB';
			$table->increments('request_action_id');
			$table->integer('request_id')->unsigned();
			$table->integer('action_id')->unsigned();
			$table->integer('transition_id')->unsigned();
			$table->tinyInteger('isActive');
			$table->tinyInteger('isComplete');
		});
		Schema::table('request_action', function ($table){
			$table->foreign('request_id')->references('request_id')->on('request')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('action_id')->references('action_id')->on('action')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('transition_id')->references('transition_id')->on('transition')->onDelete('cascade')->onUpdate('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('request_action');
    }
}
