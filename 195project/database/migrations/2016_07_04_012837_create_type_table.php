<?php<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
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
							('Officer in Charge'),
							('Admin'),
							('Approver'),
							('Supervisor'),
							('Human Resources'),
							('Team Leader'),
							('Employee')
			");
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('type');
    }
}
