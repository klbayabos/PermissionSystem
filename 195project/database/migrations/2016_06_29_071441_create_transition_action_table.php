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
            $table->integer('transition_id');
            $table->integer('action_id');
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
        //
    }
}
