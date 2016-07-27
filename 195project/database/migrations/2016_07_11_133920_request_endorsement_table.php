<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RequestEndorsementTable extends Migration
{
   public function up()
    {
		Schema::create('request_endorsement', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('request_eid');
            $table->integer('request_id')->unsigned();
			$table->enum('isEndorsed', array('endorsed', 'denied', 'no action'))->default('no action');
            $table->string('endorser')->nullable();
			$table->text('comment')->nullable();
        });
		
		Schema::table('request_endorsement', function($table){
			$table->foreign('request_id')->references('request_id')->on('request')->onDelete('cascade')->onUpdate('cascade');
		});
    }
	
    public function down(){
        Schema::drop('request_endorsement'); 
    }
}
