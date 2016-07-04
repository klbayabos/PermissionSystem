<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTargetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('activity_target', function(Blueprint $table){
			$table->engine = 'InnoDB';
			$table->increments('activity_target_id');
			$table->integer('activity_id')->unsigned();
			$table->integer('target_id')->unsigned();
			$table->integer('group_id')->unsigned();
		});
		Schema::table('activity_target', function ($table){
			$table->foreign('activity_id')->references('activity_id')->on('activity')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('activity_target');
    }
}
