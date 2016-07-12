<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RequestApprovalTable extends Migration
{
    public function up()
    {
		Schema::create('request_approval', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('request_aid');
            $table->integer('request_id')->unsigned();
			$table->enum('isApproved', array('yes', 'no', 'no action'))->default('no action');
			$table->text('approved_dates')->nullable();
			$table->text('comment')->nullable();
        });
		
		Schema::table('request_approval', function($table){
			$table->foreign('request_id')->references('request_id')->on('request')->onDelete('cascade')->onUpdate('cascade');
		});
    }

    public function down(){
        Schema::drop('request_approval'); 
    }
}
