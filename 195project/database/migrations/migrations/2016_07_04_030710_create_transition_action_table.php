<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransitionActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transition_action', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->integer('transition_id')->unsigned();
            $table->integer('action_id')->unsigned();
        });
		Schema::table('transition_action', function($table){
			$table->foreign('transition_id')->references('transition_id')->on('transition')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('action_id')->references('action_id')->on('action')->onDelete('cascade')->onUpdate('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transition_action');
    }
}
