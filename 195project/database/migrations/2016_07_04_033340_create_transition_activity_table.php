<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransitionActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transition_activity', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->integer('transition_id')->unsigned();
            $table->integer('activity_id')->unsigned();
        });
		Schema::table('transition_activity', function($table){
			$table->foreign('activity_id')->references('activity_id')->on('activity')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('transition_activity');
    }
}
