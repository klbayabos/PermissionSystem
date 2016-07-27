<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TypeTable extends Migration
{
    public function up()
    {
		Schema::create('type', function(Blueprint $table){
			$table->engine = 'InnoDB';
			$table->increments('type_id');
			$table->string('name');
		});
		Schema::table('type', function($table){
			DB::statement("INSERT INTO `type` (`name`) VALUES
							('Head of Unit'),
							('Admin'),
							('Approver'),
							('Supervisor'),
							('Human Resources'),
							('Team Leader'),
							('Employee')
			");
		});
    }

    public function down()
    {
        Schema::drop('type');
    }
}
