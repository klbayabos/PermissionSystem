<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('action_target', function(Blueprint $table){
			$table->increments('action_target_id');
			$table->integer('action_id');
			$table->integer('target_id');
			$table->integer('group_id');
		});
		Schema::table('action_target', function ($table){
			$table->foreign('action_id')->references('action_id')->on('action')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('target_id')->references('target_id')->on('target')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('group_id')->references('group_id')->on('group')->onDelete('cascade')->onUpdate('cascade');
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
