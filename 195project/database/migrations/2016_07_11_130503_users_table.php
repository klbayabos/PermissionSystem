<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UsersTable extends Migration
{
   public function up(){
        Schema::create('users', function (Blueprint $table) {
			$table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->integer('team_id')->unsigned();
            $table->integer('type_id')->unsigned();
			$table->enum('isOIC', array('yes', 'no'))->default('no');
			$table->date('OIC_starting_date')->nullable();
			$table->date('OIC_end_date')->nullable();
			$table->enum('tag', array('enabled', 'disabled'))->default('enabled');
            $table->timestamps();
			$table->rememberToken();
        });
		
		
		Schema::table('users', function($table){
			$table->foreign('team_id')->references('team_id')->on('team')->onDelete('cascade')->onUpdate('cascade');
			$table->foreign('type_id')->references('type_id')->on('type')->onDelete('cascade')->onUpdate('cascade');
		});
    }
	
    public function down(){
        Schema::drop('users');
    }
}
