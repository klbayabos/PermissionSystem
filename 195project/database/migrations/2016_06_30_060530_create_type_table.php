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
			$table->increments('type_id');
			$table->string('name');
		});
		Schema::table('type', function($table){
			DB::statement("INSERT INTO `type` (`name`) VALUES
							('Officer in Charge'),
							('Admin'),
							('Approver'),
							('Supervisor'),
							('Human Resources'),
							('Employee')
							('Team Leader')
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
        //
    }
}
