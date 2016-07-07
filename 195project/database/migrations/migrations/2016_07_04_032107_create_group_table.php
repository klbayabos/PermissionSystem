<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('group_id');
            $table->integer('process_id')->unsigned();
            $table->string('name');
        });
		Schema::table('group', function($table){
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
        Schema::drop('group');
    }
}
