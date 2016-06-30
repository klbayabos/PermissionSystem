<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('activity', function(Blueprint $table){
			$table->increments('activity_id');
			$table->integer('activity_type_id');
			$table->integer('process_id');
			$table->string('name');
			
		});
		Schema::table('activity', function($table){
			$table->foreign('activity_type_id')->references('activity_type_id')->on('activity_type')->onDelete('cascade')->onUpdate('cascade');
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
        //
    }
}
