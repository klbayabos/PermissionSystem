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
            $table->increments('action_id');
            $table->integer('action_type_id');
            $table->integer('process_id');
            $table->string('name');
        });
		Schema::table('action', function($table){
			$table->foreign('action_type_id')->references('action_type_id')->on('action_type')->onDelete('cascade')->onUpdate('cascade');
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
