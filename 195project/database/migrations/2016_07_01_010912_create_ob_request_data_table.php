<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateObRequestDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::create('ob_request_data', function(Blueprint $table){
			$table->increments('ob_data_id');
			$table->integer('request_id');
			$table->string('to');
			$table->string('from');
		});
		Schema::table('ob_request_data', function($table){
			$table->foreign('request_id')->references('request_id')->on('request')->onDelete('cascade')->onUpdate('cascade');
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
