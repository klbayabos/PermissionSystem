<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('state', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('state_id');
            $table->integer('state_type_id')->unsigned();
            $table->integer('process_id')->unsigned();
            $table->string('name');
        });
		Schema::table('state', function($table){
			$table->foreign('state_type_id')->references('state_type_id')->on('state_type')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::drop('state'); 
    }
}
