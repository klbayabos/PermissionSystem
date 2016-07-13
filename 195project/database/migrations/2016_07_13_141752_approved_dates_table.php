<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ApprovedDatesTable extends Migration
{
    public function up()
    {
		Schema::create('approved_dates', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('approved_date_id')->unsigned();
            $table->integer('request_aid')->unsigned();
			$table->date('approved_date');
        });
		
		Schema::table('approved_dates', function($table){
			$table->foreign('request_aid')->references('request_aid')->on('request_approval')->onDelete('cascade')->onUpdate('cascade');
		});
    }

    public function down(){
        Schema::drop('approved_dates'); 
    }
}
