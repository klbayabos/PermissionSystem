<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestNoteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('request_note', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('request_note_id');
            $table->integer('request_id')->unsigned();
            $table->integer('action_id')->unsigned();
			$table->longtext('note');
        });
		Schema::table('request_note', function($table){
			$table->foreign('request_id')->references('request_id')->on('request')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('request_note'); 
    }
}
