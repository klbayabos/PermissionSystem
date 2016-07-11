<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transition', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('transition_id');
            $table->integer('process_id')->unsigned();
            $table->integer('current_state_id')->unsigned();
            $table->integer('next_state_id')->unsigned();
        });
		Schema::table('transition', function($table){
			$table->foreign('current_state_id')->references('state_id')->on('state')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('next_state_id')->references('state_id')->on('state')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('transition');
    }
}
