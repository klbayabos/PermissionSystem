<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('action_id');
            $table->integer('action_type_id')->unsigned();
            $table->integer('process_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->timestamps();
        });
		Schema::table('action', function($table){
			$table->foreign('action_type_id')->references('action_type_id')->on('action_type')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('process_id')->references('process_id')->on('process')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('action'); 
    }
}
