<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RequestTable extends Migration
{
     public function up()
    {
        Schema::create('request', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('request_id');
            $table->integer('id')->unsigned();
            $table->integer('team_id')->unsigned()->nullable();
            $table->enum('type', array('Overtime', 'Overnight', 'Official Business'))->default('Overtime');
			$table->date('starting_date');
			$table->date('end_date');
			$table->time('starting_time');
			$table->time('end_time');
			$table->text('request_purpose');
            $table->enum('status', array('Submitted', 'Endorsed for approval', 'Endorsed for disapproval', 'Approved', 'Denied'))->default('Submitted');
            $table->timestamps();
        });
		Schema::table('request', function($table){
			$table->foreign('id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('team_id')->references('team_id')->on('users')->onDelete('set null')->onUpdate('cascade');
		});
    }

    public function down(){
        Schema::drop('request'); 
    }
}
