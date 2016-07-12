<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ObRequestDataTable extends Migration
{
    public function up()
    {
		Schema::create('ob_request_data', function(Blueprint $table){
			$table->engine = 'InnoDB';
			$table->integer('request_id')->unsigned();
			$table->string('to');
			$table->string('from');
		});
		Schema::table('ob_request_data', function($table){
			$table->foreign('request_id')->references('request_id')->on('request')->onDelete('cascade')->onUpdate('cascade');
		});
    }

    public function down(){
        Schema::drop('ob_request_data'); 
    }
}
